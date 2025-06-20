<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pieza extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'pieza',
        'peso_teorico',
        'peso_real',
        'estado',
        'bloque_id',
        'user_id',
        'bloque_id',
        'user_id',
    ];
    protected $casts = [
        'peso_teorico' => 'float',
        'peso_real' => 'float',
    ];

    protected $with = [
        'bloque',
        'user',
    ];

    public function bloque(){
        return $this->belongsTo(Bloque::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
