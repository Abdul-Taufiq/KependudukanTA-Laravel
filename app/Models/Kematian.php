<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kematian extends Model
{
    
    protected $table ='tb_kematian';
    protected $dates =['tgl_kematian'];
    protected $primaryKey ='id_kematian';

    public function penduduk()
    {
        return $this->hasMany(Penduduk::class, 'id_kematian', 'id_kematian');
    }
}
