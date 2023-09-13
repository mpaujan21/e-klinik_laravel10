<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Jadwal;
use App\Models\Pasien;

class Kunjungan extends Model
{
    protected $table = 'kunjungans';
    protected $primaryKey = 'id_kunjungan';
    protected $fillable = ['id_jadwal', 'id_pasien', 'no_antrian'];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id_jadwal');
    }
    public function pasien()
    {
        return $this->hasMany(Pasien::class, 'id_pasien', 'id_pasien');
    }
}
