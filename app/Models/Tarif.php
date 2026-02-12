<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    protected $fillable = ['jenis_kendaraan', 'tarif_per_jam'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
