<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pieza; 
use App\Http\Resources\PiezaResource;


class PiezaController extends Controller
{
    public function index(){
        $piezas = PiezaResource::collection(Pieza::all());
        return inertia('Piezas/Index', [
            'piezas' => $piezas,
        ]);
    }
}
