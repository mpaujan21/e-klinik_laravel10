<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Jadwal;

class Daftar extends Component
{
    public $idPoli;
    public $dokters;
    public $dokter;
    public $tanggalKunjungans;
    public $tanggalKunjungan;
    public $jadwal;
    public $kuota;
    public $sisa_kuota;
    public $message;
    public $id_jadwal;
    public $id_pasien;

    public function render()
    {
        return view('livewire.daftar');
    }

    public function updatedIdPoli($value)
    {
        unset($this->tanggalKunjungan);
        unset($this->dokter);
        unset($this->sisa_kuota);
        unset($this->message);
        $this->message = 'Tidak ada jadwal dokter';
    }

    public function updated($value)
    {
        unset($this->tanggalKunjungan);
        unset($this->dokter);
        unset($this->sisa_kuota);
        unset($this->message);
        $this->message = 'Tidak ada jadwal dokter';
    }

    public function updatedTanggalKunjungan($value)
    {
        unset($this->dokter);
        unset($this->message);
        
        $this->jadwal = Jadwal::join('dokters', 'jadwals.id_dokter', '=', 'dokters.id_dokter')
                            ->join('users', 'dokters.username', '=', 'users.username')
                            ->where('tanggal', $value)
                            ->where('id_poli', $this->idPoli)
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
