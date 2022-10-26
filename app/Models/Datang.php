<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datang extends Model
{
    protected $table='tb_datang';
    protected $dates =['tgl_datang'];
    protected $primaryKey = 'id_datang';

    public function penduduk()
    {
        return $this->hasMany(Penduduk::class, 'id_datang', 'id_datang');
    }
}
