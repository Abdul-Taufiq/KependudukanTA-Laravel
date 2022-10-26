<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelahiran extends Model
{
    protected $table='tb_kelahiran';
    protected $primaryKey = 'id_kelahiran';

    public function penduduk()
    {
        return $this->hasMany(Penduduk::class, 'id_kelahiran', 'id_kelahiran');
    }
}
