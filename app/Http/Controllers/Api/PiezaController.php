<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\ListPiezasRequest;
use App\Http\Resources\PiezaResource;
use App\Models\Pieza;

class PiezaController extends Controller
{
    public function __invoke(ListPiezasRequest $request)
    {
        //piezas que esten en estado Pendiete
        $piezas = Pieza::where('bloque_id', $request->bloque_id)
            ->where('estado', 'Pendiente')
            ->get();
        

        return PiezaResource::collection($piezas);
    }
    public function show($id)
    {
        $pieza = Pieza::findOrFail($id);
        return PiezaResource::make($pieza);
    }

}
