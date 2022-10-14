<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Cafe extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'detail__cafes';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function cafe()
    {
        return $this->belongsTo(Cafe::class,"id_cafe");
    }
}
