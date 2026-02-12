<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'kendaraan_id', 'waktu_masuk', 'waktu_keluar',
        'tarif_id', 'durasi_jam', 'biaya_total',
        'status', 'user_id', 'area_id',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function tarif()
    {
        return $this->belongsTo(Tarif::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function area()
    {
        return $this->belongsTo(AreaParkir::class);
    }
}
