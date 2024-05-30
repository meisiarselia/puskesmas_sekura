<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'id',
        'pasien_id',
        'kode',
        'tgl_berobat',
        'tgl_pendaftaran',
        'cara_bayar',
        'no_bpjs',
        'no_rekam_medis',
        'poli_id'
    ];
    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }
    protected $casts = [
        'id' => 'string',
    ];
}
