<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pindah extends Model
{
    protected $table='tb_pindah';
    protected $dates =['tgl_pindah'];
    protected $primaryKey = 'id_pindah';

    public function penduduk()
    {
        return $this->hasMany(Penduduk::class, 'id_pindah', 'id_pindah');
    }
}
