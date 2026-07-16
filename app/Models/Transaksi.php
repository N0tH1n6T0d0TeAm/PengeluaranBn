<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function details()
    {
        return $this->hasMany(Pembelian_Detail::class,"id_transaksi");
    }

    public function transaksi_detail() {
        return $this->hasMany(Pembelian_Detail::class,"id_transaksi");
    }
}
