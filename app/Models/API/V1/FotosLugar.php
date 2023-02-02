<?php

namespace App\Models\API\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotosLugar extends Model
{
    use HasFactory;

    protected $fillable = [
        'imagen',
        'lugar_id',
    ];

    public function Lugar(){
        return $this->belongsTo(Lugar::class);
    }
}
