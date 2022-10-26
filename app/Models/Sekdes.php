<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekdes extends Model
{
    use HasFactory;
    protected $table='tb_sekdes';
    protected $dates =['tgl_lahir'];
    protected $primaryKey = 'id_sekdes';
}
