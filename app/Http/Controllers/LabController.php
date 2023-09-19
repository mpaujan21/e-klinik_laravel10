<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

use App\Models\Pasien;
use App\Models\Lab;
use App\Models\RekamMed;

class LabController extends Controller
{
    // Route::get('/lab')
    public function index()
    {
        $rms = RekamMed::where('deleted', '<>', '1')->where('status_lab', 1)->get();
        $page_hasil = 0;
        return view('lab.index', compact('rms', 'page_hasil'));
    }

    // Route::get('/hasil_lab')
    public function hasil_lab()
    {
        $rms = RekamMed::where('deleted', '<>', '1')->where('status_lab', 2)->get();
        $page_hasil = 1;
        return view('lab.index', compact('rms', 'page_hasil'));
    }

    // Route::get('/lab/input/{id}')
    public function input_hasil_lab($id)
    {
        $datas = RekamMed::where('id_rm', $id)->get();
        if ($datas->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan.');
        }
        
        foreach ($datas as $data) {
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

        $labs = Lab::all();
        return view('lab.input', compact('idens', 'datas', 'labs',  'num'));
    }

    // Route::post('/lab/simpan/')
    public function simpan_hasil_lab(Request $request)
    {
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

        RekamMed::where('id_rm', $request->id)->update([
            'id_labs' => $lab_id,
            'hasil_labs' => $lab_hasil,
            'status_lab' => 2,
        ]);

        $pesan = "Hasil lab berhasil disimpan!";
        return redirect('lab')->with('pesan', $pesan);
    }
}
