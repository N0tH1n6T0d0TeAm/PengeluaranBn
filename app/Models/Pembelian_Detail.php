<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian_Detail extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $table = 'pembelian__details';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function menu()
    {
        return $this->belongsTo(Menu::class,"id_rempah");
    }
}
