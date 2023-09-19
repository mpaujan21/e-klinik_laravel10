<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Obat;
use App\Exports\ObatExport;
use App\Exports\ObatImport;

class ObatController extends Controller
{
    // Route::get('/obat')
    public function index()
    {
        $obats = Obat::where('deleted', '<>', 1)->get();
        return view('obat.index', compact('obats'));
    }

    // Route::get('/obat/tambah/')
    public function tambah_obat()
    {
        return view('obat.tambah');
    }

    // Route::post('/obat/tambah/simpan')
    public function simpan_obat(Request $request)
    {
        $this->validate($request, [
            'nama_obat' => 'required|min:4|max:25',
            'jenis' => 'required',
            'dosis' => 'required|numeric|digits_between:1,7',
            'satuan' => 'required',
            'stok' => 'required|numeric|digits_between:1,5'
        ]);
        
        Obat::create([
            'nama_obat' => $request->nama_obat,
            'jenis' => $request->jenis,
            'dosis' => $request->dosis,
            'satuan' => $request->satuan,
            'stok' => $request->stok,
            'deleted' => 0,
	    ]);

        $ids = Obat::orderBy('id_obat', 'desc')->first();
        switch ($request->simpan) {
            case 'simpan':
                $buka = route('obat.edit', $ids->id_obat);
                break;
            case 'simpan_baru':
                $buka = route('obat.tambah');
                break;
        }
        $pesan = 'Data obat berhasil disimpan!';
        return redirect($buka)->with('pesan', $pesan);
    }

    // Route::post('/obat/edit/update/')
    public function update_obat(Request $request)
    {
        $this->validate($request, [
            'nama_obat' => 'required|min:4|max:25',
            'jenis' => 'required',
            'dosis' => 'required|numeric|digits_between:1,7',
            'satuan' => 'required',
            'stok' => 'required|numeric|digits_between:1,5'
        ]);

        Obat::where('id_obat', $request->id)->update([
            'nama_obat' => $request->nama_obat,
            'jenis' => $request->jenis,
            'dosis' => $request->dosis,
            'satuan' => $request->satuan,
            'stok' => $request->stok
	    ]);

        switch ($request->simpan) {
            case 'simpan':
                $buka = route('obat.edit', $request->id);
                break;
            case 'simpan_baru':
                $buka = route('obat.tambah');
                break;
        }
        $pesan = 'Data obat berhasil disimpan!';
        return redirect($buka)->with('pesan', $pesan);
    }

    // Route::get('/obat/edit/{id}')
    public function edit_obat($id)
    {
        $datas = Obat::where('id_obat', $id)->get();
        if ($datas->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan.');
        }
        return view('obat.edit', compact('datas'));
    }

    // Route::delete('/obat/hapus/{id}')
    public function hapus_obat($id)
    {
        Obat::where('id_obat', $id)->update([
            'deleted' => 1,
	    ]);

        $pesan = "Data obat berhasil dihapus!";
        return redirect(route("obat"))->with('pesan', $pesan);
    }

    // Route::get('/obat/excel')
    public function excel()
    {
        return view('obat.excel');
    }
    
    // Route::get('/obat/export_excel')
    public function export_excel()
    {
        return Excel::download(new ObatExport, 'stok_obat.xlsx');
    }
    
    //TODO baru fitur upload, next tambah simpan obat tergantung template user
    // Route::post('/obat/import_excel')
    public function import_excel(Request $request)
    {
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		$file = $request->file('file');
        $nama_file = rand().$file->getClientOriginalName();
 
		$file->move('file_obat',$nama_file);
		Excel::import(new ObatImport, public_path('/file_obat/'.$nama_file));
 
        $pesan = "Data obat berhasil diupload!";
        return redirect(route("obat"))->with('pesan', $pesan);
    }
}
