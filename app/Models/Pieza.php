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
        'user_id',
    ];
    protected $casts = [
        'cantidad' => 'integer',
    ];

    protected $with = [
        'proveedor',
        'user',
    ];

    //modelos eloquent
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
    public function scopeSearch($query, $search)
    {
        return $query->where('codigo', 'like', "%{$search}%")
                     ->orWhere('nombre', 'like', "%{$search}%")
                     ->orWhere('descripcion', 'like', "%{$search}%");
    }
}
