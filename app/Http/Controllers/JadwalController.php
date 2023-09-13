<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kunjungan;
use App\Models\User;

class JadwalController extends Controller
{   
    // Route::get('/jadwal')
    public function jadwal_pasien(Request $request)
    {
        $user = $request->user();
        $name = $user->nama;
        $id_pasien = User::where('username', $user->username)->first()->pasien->id_pasien;
        $kunjungans = Kunjungan::where('id_pasien', $id_pasien)->where('deleted', 0)->get() ?? null;

        return view('jadwal.pasien', compact('kunjungans', 'name'));
    }
}
