<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'cafes';
    protected $primaryKey = 'id_cafe';
    protected $guarded = [];


    
    public function detail_cafe()
    {
        return $this->hasMany('App\Models\Detail_Cafe');
    }
}
