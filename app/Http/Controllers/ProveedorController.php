<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Http\Requests\ListProveedoresRequest;

class ProveedorController extends Controller
{
    public function __invoke(ListProveedoresRequest $request)
    {
        $proveedores = Proveedor::where('proveedor_id', $request->proveedor_id)
            ->orderBy('nombre', 'asc')
            ->get();

        return ProveedorResource::collection($proveedores);
    }
}
