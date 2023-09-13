<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Dokter;
use App\Models\Kunjungan;

class Jadwal extends Model
{
    protected $table = 'jadwals';
    protected $primaryKey = 'id_jadwal';
    protected $fillable = ['id_dokter', 'tanggal', 'kuota', 'sisa_kuota', 'deleted'];

    public function kunjungan()
    {
        return $this->hasMany(Kunjungan::class, 'id_jadwal', 'id_jadwal');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }
}
