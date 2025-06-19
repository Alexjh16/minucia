<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pieza extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'precio',
        'cantidad',
        'marca',
        'modelo',
        'proveedor_id',
        'proyecto_id',
        'user_id',
    ];
    protected $casts = [
        'cantidad' => 'integer',
    ];

    protected $with = [
        'proveedor',
        'user',
    ];

    //remover 
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function bloque(){
        return $this->belongsTo(Bloque::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
