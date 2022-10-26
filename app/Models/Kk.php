<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kk extends Model
{
    protected $table='tb_kk';
    protected $dates =['created_at'];
    protected $primaryKey = 'id_kk';

    public function penduduk()
    {
        return $this->hasMany(Penduduk::class, 'id_kk', 'id_kk');
    }

}
