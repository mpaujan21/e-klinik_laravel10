<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\KodeIcd;
use App\Models\Dokter;
use App\Models\Pasien;

class RekamMed extends Model
{
    protected $table = 'rekam_meds';
    protected $primaryKey = 'id_rm';
    protected $fillable = [
        'id_pasien', 'id_dokter', 'id_diagnosis', 'keluhan', 'anamnesis',
        'pfisik', 'id_labs', 'hasil_labs', 'id_obats', 'jumlah_obats',
        'aturan_obats', 'status_lab'];

    public function diagnosis()
    {
        return $this->hasOne(KodeIcd::class, 'id_diagnosis', 'id_diagnosis');
    }
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }
}
