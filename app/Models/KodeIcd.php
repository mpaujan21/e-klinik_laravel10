<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\RekamMed;

class KodeIcd extends Model
{
    protected $table = 'kode_icds';
    protected $primaryKey = 'id_diagnosis';

    public function diagnosis()
    {
        return $this->belongsTo(RekamMed::class, 'id_diagnosis', 'id_diagnosis');
    }
}
