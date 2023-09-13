<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kunjungan;
use App\Models\Jadwal;
use App\Models\User;

class DaftarController extends Controller
{
    // Route::get('/pendaftaran')
    public function index(Request $request)
    {
        $pasien = User::where('username', $request->user()->username)->first()->pasien ?? null;
        return view('pendaftaran.index', compact('pasien'));
    }

    // Route::post('/pendaftaran')
    public function daftar_kunjungan(Request $request)
    {
        $this->validate($request, [
            'dokter' => 'required',
        ],
        [
            'dokter.required' => 'Tidak ada jadwal dokter!',
        ]);

        $this->validate($request, [
            'sisa_kuota' => 'required'
        ],
        [
            'sisa_kuota.required' => 'Kuota antrian sudah habis!',
        ]);

        $no_antrian = $request->kuota - $request->sisa_kuota + 1;
        --$request->sisa_kuota;

        Kunjungan::create([
            'id_jadwal' => $request->id_jadwal,
            'id_pasien' => $request->id_pasien,
            'no_antrian' => $no_antrian,
	    ]);
        
        Jadwal::where('id_jadwal', $request->id_jadwal )->update([
            'sisa_kuota' => $request->sisa_kuota,
	    ]);
        
        $pesan = 'Jadwal kunjungan berhasil dibuat!';
        return redirect(route('jadwal.pasien'))->with('pesan', $pesan);
    }

    // Route::delete('/jadwal/hapus/{id}')
    public function hapus_kunjungan($id)
    {
        Kunjungan::where('id_kunjungan', $id)->update([
            'deleted' => 1,
        ]);

        $pesan = "Kunjungan berhasil dihapus!"; 
        return redirect(route('jadwal.pasien'))->with('pesan', $pesan);
    }
}
