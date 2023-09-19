<?php

namespace App\Http\Livewire;

use Auth;
use Livewire\Component;

use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class FormDaftar extends Component
{
    public $poli;
    public $dokters;
    public $dokter;
    public $tanggal;
    public $jadwal;
    public $kuota;
    public $sisa_kuota;
    public $message;
    public $id_jadwal;

    public function render()
    {
        $this->id_pasien = Auth::User()->pasien->id_pasien;
        return view('livewire.form-daftar');
    }

    public function updatedPoli($value)
    {
        unset($this->tanggal);
        unset($this->dokter);
        unset($this->sisa_kuota);
        unset($this->message);
    }
    public function updatedTanggal($value)
    {
        unset($this->dokter);
        unset($this->message);
        
        $this->jadwal = Jadwal::join('dokters', 'jadwals.id_dokter', '=', 'dokters.id_dokter')
                            ->join('users', 'dokters.username', '=', 'users.username')
                            ->where('tanggal', $value)
                            ->where('id_poli', $this->poli)
                            ->orderby('sisa_kuota', 'desc')
                            ->get(['jadwals.*', 'dokters.id_dokter', 'users.nama'])
                            ->first();
        $this->dokter = $this->jadwal->nama ?? null;
        $this->kuota = $this->jadwal->kuota ?? null;
        $this->sisa_kuota = $this->jadwal->sisa_kuota ?? null;
        $this->id_jadwal = $this->jadwal->id_jadwal ?? null;

        if ($this->dokter == null) {
            $this->message = 'Tidak ada jadwal dokter';
        }

        if ($this->sisa_kuota == 0) {
            $this->sisa_kuota = null;
        }
    }
}
