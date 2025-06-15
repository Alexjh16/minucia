<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'proveedores';
    protected $fillable = [
        'nombre',
        'telefono',
        'email',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

     //un provedor es registrado por un usuario
     public function user()
     {
         return $this->belongsTo(User::class);
     }
}
