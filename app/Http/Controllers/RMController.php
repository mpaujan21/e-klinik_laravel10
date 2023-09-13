<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Models\Dokter;
use App\Models\KodeIcd;
use App\Models\Lab;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\RekamMed;

class RMController extends Controller
{
    public $pasiens;

    public function __construct(){
        $this->pasiens = Pasien::all();
    }

    // Route::delete('/rm/hapus/{id}')
    public function hapus_rm($id)
    {
        RekamMed::where('id_rm', $id)->update([
            'deleted' => 1,
        ]);
        $pesan = "Rekam medis berhasil dihapus!";
        return redirect(route('rm.riwayat'))->with('pesan', $pesan);
    }

    // TODO satuin sama simpan_rm
    public function update_rm(Request $request)
    {
        $this->validate($request, [
            'idpasien' => 'required|numeric|digits_between:1,4',
            'keluhan_utama' => 'required|max:40',
            'anamnesis' => 'required|max:1000',
            'px_fisik' => 'required|max:1000',
            'diagnosis' => 'required|max:40',
            'dokter' => 'required',
        ]);
        
        // Decoding array input pemeriksaan lab
        if (isset($request->lab)) {
            if (has_dupes(array_column($request->lab, 'id'))) {
                $errors = new MessageBag(['lab' => ['Lab yang sama tidak boleh dimasukan berulang']]);
                return back()->withErrors($errors);
            }


            $this->validate($request, [
                'lab.*.hasil' => 'required|numeric|digits_between:1,4',
            ]);
            $lab_id = decode('lab', 'id', $request->lab);
            $lab_hasil = decode('lab', 'hasil', $request->lab);
        } else {
            $lab_id = "";
            $lab_hasil = "";
        }

        // Decoding array input resep
        if (isset($request->resep)) {
            if (has_dupes(array_column($request->resep, 'id'))) {
                $errors = new MessageBag(['resep' => ['resep yang sama tidak boleh dimasukan berulang']]);
                return back()->withErrors($errors);
            }
            $this->validate($request, [
                'resep.*.jumlah' => 'required|numeric|digits_between:1,3',
                'resep.*.aturan' => 'required',
            ]);
            $resep_id = decode('resep', 'id', $request->resep);
            $resep_jumlah = decode('resep', 'jumlah', $request->resep);
            $resep_dosis = decode('resep', 'aturan', $request->resep);
        } else {
            $resep_id = "";
            $resep_jumlah = "";
            $resep_dosis = "";
        }

        $newresep = array();

        $oldresep = array_combine(encode(get_value('rm', $request->id, 'resep', 'id_rm')), encode(get_value('rm', $request->id, 'jumlah', 'id_rm')));
        foreach ($request->resep as $resep) {
            $newresep[$resep['id']] = $resep['jumlah'];
        }
        if (empty($oldresep)) {
            $resultanresep = resultan_resep($oldresep, $newresep);
        } else {
            $resultanresep = $newresep;
        }
        $errors = validasi_stok($resultanresep);
        if ($errors !== NULL) {
            return  back()->withErrors($errors);
        }

        foreach ($resultanresep as $key => $value) {
            $perintah = kurangi_stok($key, $value);
            if ($perintah === false) {
                $habis = array_push($habis, $key);
            }
        }

        DB::table('rm')->where('id', $request->id)->update([
            'idpasien' => $request->idpasien,
            'ku' => $request->keluhan_utama,
            'anamnesis' => $request->anamnesis,
            'pxfisik' => $request->px_fisik,
            'lab' => $lab_id,
            'hasil' => $lab_hasil,
            'id_diagnosis' => $request->id_diagnosis,
            'resep' => $resep_id,
            'jumlah' => $resep_jumlah,
            'aturan' => $resep_dosis,
            'dokter' => $request->dokter,
            'updated_time' => Carbon::now(),
        ]);

        switch ($request->simpan) {
            case 'simpan_edit':
                $buka = route('rm.edit', $request->id);
                $pesan = 'Data Rekam Medis berhasil disimpan!';
                break;
            case 'simpan_baru':
                $buka = route('rm.tambah.id', $request->idpasien);
                $pesan = 'Data Rekam Medis berhasil disimpan!';
                break;
        }

        return redirect($buka)->with('pesan', $pesan);
    }
    
    // TODO read & edit
    // Route::get('/rm/edit/{id}')
    public function edit_rm($id)
    {
        $datas = RekamMed::where('id_rm', $id)->get();
        if ($datas->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan.');
        }
        foreach ($datas as $data) {
            //mencari id pasien dari id RM
            if ($data->id_pasien != NULL) {
                $id_pasien = $data->id_pasien;
                $idens = Pasien::where('id_pasien', $id_pasien)->get();
            }
            if ($data->id_labs != NULL) {
                $data->labhasil = array_combine(encode($data->id_labs), encode($data->hasil_labs));
                $num['lab'] = sizeof($data->labhasil);
            } else {
                $num['lab'] = 0;
            }
            if ($data->id_obats != NULL) {
                $data->allresep = array_combine(encode($data->id_obats), encode($data->aturan_obats));
                $data->jum = encode($data->jumlah_obats);
                $num['resep'] = sizeof($data->allresep);
            } else {
                $num['resep'] = 0;
            }
        }
        // $dokters = DB::table('users')->where('profesi', 'Dokter')->get();
        $icds = KodeIcd::all();
        $dokters = Dokter::all();
        $labs = Lab::all();
        $obats = Obat::where('deleted', 0)->get();

        return view('rm.edit', compact('idens', 'datas', 'labs', 'obats', 'num', 'dokters', 'icds'));
    }

    // Route::get('/rm/input')
    public function input_rm()
    {
        $pasiens = $this->pasiens;
        $cont = [
            'aria' => 'true',
            'show' => 'show',
            'col' => ''
        ];
        return view('rm.input', compact('pasiens', 'cont'));
    }

    // Route::get('/rm/input/{idpasien}')
    public function input_rmid($id_pasien)
    {
        $pasiens = $this->pasiens;
        $icds = KodeIcd::all();
        $dokters = Dokter::all();
        $labs = Lab::all();
        $idens = Pasien::where('id_pasien', $id_pasien)->get();
        $obats = Obat::where('deleted', 0)->get();
        $cont = [
            'aria' => 'false',
            'show' => '',
            'col' => 'collapsed'
        ];

        return view('rm.input', compact('idens', 'pasiens', 'cont', 'labs', 'obats', 'icds', 'dokters'));
    }

    // Route::get('/rm/riwayat')
    public function riwayat_rm()
    {
        $pasiens = $this->pasiens;
        $cont = [
            'aria' => 'true',
            'show' => 'show',
            'col' => ''
        ];

        // Riwayat RM untuk pasien/dokter
        if (Auth::User()->role === 4) {
            $idens = Pasien::where('username', Auth::User()->username)->get();
            $id_pasien = $idens->first()->id_pasien;
            $rms = RekamMed::where('id_pasien', $id_pasien)->where('deleted', '<>', 1)->get();
            return view('rm.riwayat', compact('idens', 'rms', 'pasiens', 'cont'));
        }
        else {
            return view('rm.riwayat', compact('pasiens', 'cont'));
        }
    }

    // Route::get('/rm/riwayat/{idpasien}')
    public function riwayat_rmid($id_pasien)
    {
        $pasiens = $this->pasiens;
        $idens = Pasien::where('id_pasien', $id_pasien)->get();
        $rms = RekamMed::where('id_pasien',$id_pasien)->where('deleted', '<>', 1)->get();
        $cont = [
            'aria' => 'false',
            'show' => '',
            'col' => 'collapsed'
        ];

        if ($idens->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan.');
        }
        return view('rm.riwayat', compact('idens', 'rms', 'pasiens', 'cont'));
    }

    // TODO read code update stok obat
    // Route::post('/rm/simpan/')
    public function simpan_rm(Request $request)
    {
        $this->validate($request, [
            'id_pasien' => 'required|numeric|digits_between:1,4',
            'keluhan_utama' => 'required|max:40',
            'anamnesis' => 'required|max:1000',
            'pfisik' => 'max:1000',
            'id_diagnosis' => 'required',
            'id_dokter' => 'required',
        ]);
        
        // Decoding array input pemeriksaan lab
        if (isset($request->lab)) {
            if (has_dupes(array_column($request->lab, 'id'))) {
                $errors = new MessageBag(['lab' => ['Lab yang sama tidak boleh dimasukan berulang']]);
                return back()->withErrors($errors);
            }
            // $this->validate($request, [
            //     'lab.*.hasil' => 'required|numeric|digits_between:1,4',
            // ]);
            $lab_id = decode('lab', 'id', $request->lab);
            $lab_hasil = decode('lab', 'hasil', $request->lab);
            $status_lab = 1;
        } else {
            $lab_id = "";
            $lab_hasil = "";
            $status_lab = 0;
        }

        // Decoding array input resep
        if (isset($request->resep)) {
            if (has_dupes(array_column($request->resep, 'id'))) {
                $errors = new MessageBag(['resep' => ['resep yang sama tidak boleh dimasukan berulang']]);
                return back()->withErrors($errors);
            }
            $this->validate($request, [
                'resep.*.jumlah' => 'required|numeric|digits_between:1,3',
                'resep.*.aturan' => 'required',
            ]);
            $resep_id = decode('resep', 'id', $request->resep);
            $resep_jumlah = decode('resep', 'jumlah', $request->resep);
            $resep_dosis = decode('resep', 'aturan', $request->resep);
        } else {
            $resep_id = "";
            $resep_jumlah = "";
            $resep_dosis = "";
        }
        $newresep = array();
        $oldresep = array();
        foreach ($request->resep as $resep) {
            $newresep[$resep['id']] = $resep['jumlah'];
        }
        if (empty($oldresep)) {
            $resultanresep = resultan_resep($oldresep, $newresep);
        } else {
            $resultanresep = $newresep;
        }
        // $errors = validasi_stok($resultanresep);
        $errors = NULL;
        if ($errors !== NULL) {
            return  back()->withErrors($errors);
        }

        // foreach ($resultanresep as $key => $value) {
        //     $perintah = kurangi_stok($key, $value);
        //     if ($perintah === false) {
        //         $habis = array_push($habis, $key);
        //     }
        // }

        RekamMed::create([
            'id_pasien' => $request->id_pasien,
            'id_dokter' => $request->id_dokter,
            'id_diagnosis' => $request->id_diagnosis,
            'keluhan' => $request->keluhan_utama,
            'anamnesis' => $request->anamnesis,
            'pfisik' => $request->pfisik,
            'id_labs' => $lab_id,
            'hasil_labs' => $lab_hasil,
            'id_obats' => $resep_id,
            'jumlah_obats' => $resep_jumlah,
            'aturan_obats' => $resep_dosis,
            'status_lab' => $status_lab,
        ]);

        $pesan = 'Data Rekam Medis berhasil disimpan!';
         return redirect(route('rm.input'))->with('pesan',$pesan);
    }

    // TODO edit tampilan
    // Route::get('/rm/lihat/{id}')
    public function lihat_rm($id)
    {
        $datas = RekamMed::where('id_rm', $id)->get();
        if ($datas->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan.');
        }

        foreach ($datas as $data) {
            // TODO read again
            $id_pasien = $data->id_pasien;
            if ($data->id_labs != NULL) {
                $data->labhasil = array_combine(encode($data->id_labs), encode($data->hasil_labs));
                $num['lab'] = sizeof($data->labhasil);
            } else {
                $num['lab'] = 0;
            }
            if ($data->id_obats != NULL) {
                $data->allresep = array_combine(encode($data->id_obats), encode($data->aturan_obats));
                $data->jum = encode($data->jumlah_obats);
                $num['resep'] = sizeof($data->allresep);
            } else {
                $num['resep'] = 0;
            }
        }
        
        $labs = Lab::all();
        $obats = Obat::all();
        $idens = Pasien::where('id_pasien', $id_pasien)->get();
        return view('rm.lihat', compact('idens', 'datas', 'labs', 'obats', 'num'));
    }
}
