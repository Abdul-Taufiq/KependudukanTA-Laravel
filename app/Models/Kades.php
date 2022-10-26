<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kades extends Model
{
	use HasFactory;
    protected $table='tb_kades';
    protected $dates =['tgl_lahir'];
    protected $primaryKey = 'id_kades';
}
