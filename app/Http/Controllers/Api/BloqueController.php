<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\ListBloquesRequest;
use App\Http\Resources\BloqueResource;
use App\Models\Bloque;

class BloqueController extends Controller
{
    public function __invoke(ListBloquesRequest $request)
    {
        $bloques = Bloque::where('proyecto_id', $request->proyecto_id)
            ->get();

        return BloqueResource::collection($bloques);
    }
}
