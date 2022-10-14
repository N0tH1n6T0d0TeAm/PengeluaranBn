<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Transaksi_Cafe extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'transaksi__cafes';
    protected $primaryKey = 'id';
    protected $guarded = [];

 
    public function detail_cafes()
    {
        return $this->hasMany(Detail_Cafe::class,"id_transaksi_cafe");
    }
}
