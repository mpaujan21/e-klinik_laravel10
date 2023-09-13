<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Jadwal;

class Pasien extends Model
{
    protected $table = 'pasiens';
    protected $primaryKey = 'id_pasien';
    public $timestamp = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_pasien', 'id_pasien');
    }
}
