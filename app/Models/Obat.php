<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'obats';
    protected $fillable = ['nama_obat', 'jenis', 'dosis', 'satuan', 'stok'];
}
