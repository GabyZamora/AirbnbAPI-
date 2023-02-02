<?php

namespace App\Models\API\V1;

use App\Models\API\V1\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Lugar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'user_id',
        'categoria_id',
        'direccion',
        'numhuesped',
        'precio',
        'imagen',
        'estado',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function getPublishedAtAtribute()
    {
        return $this->created_at->format('d/m/Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function FotosLugar()
    {
        return $this->hasMany(FotosLugar::class);
    }

    /*public static function boot()
    {
        parent::boot();
        static::creating(function ($lugar) {
            $lugar->user_id = Auth::id();
        });
    }*/
}
