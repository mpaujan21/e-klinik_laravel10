<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $table = 'labs';
    protected $primaryKey = 'id_lab';
    public $timestamp = false;
}
