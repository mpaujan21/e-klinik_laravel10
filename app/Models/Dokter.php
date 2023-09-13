<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Jadwal;
use App\Models\User;

class Dokter extends Model
{
    protected $table = 'dokters';
    protected $primaryKey = 'id_dokter';
    public $timestamp = false;

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_dokter', 'id_dokter');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
