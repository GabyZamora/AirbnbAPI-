<?php

namespace App\Models\API\V1;

use App\Models\API\V1\User;
use App\Models\API\V1\Lugar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'checkin',
        'checkout',
        'lugar_id',        
        'user_id',
        'numhuesped',
        'preciototal',
        'estado'
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

    public function lugar()
    {
        return $this->belongsTo(Lugar::class);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($reserva) {
            $reserva->user_id = Auth::id();
        });
    }
}
