<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;
    protected $table='tb_penduduk';
    protected $dates =['tgl_lahir'];
    protected $primaryKey = 'id_penduduk';

    public function kk()
    {
        return $this->belongsTo(Kk::class, 'id_kk', 'id_kk');
    }

    public function Kelahiran()
    {
        return $this->belongsTo(Kelahiran::class, 'id_kelahiran', 'id_kelahiran');
    }

    public function Kematian()
    {
        return $this->belongsTo(Kematian::class, 'id_kematian', 'id_kematian');
    }

    public function Pindah()
    {
        return $this->belongsTo(Pindah::class, 'id_pindah', 'id_pindah');
    }

    public function Datang()
    {
        return $this->belongsTo(Datang::class, 'id_datang', 'id_datang');
    }

}
