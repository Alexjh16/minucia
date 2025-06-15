<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pieza; 
use App\Http\Resources\PiezaResource;
use App\Models\Proveedor;
use App\Http\Resources\ProveedorResource;
use App\Http\Requests\StorePiezaRequest;
use App\Http\Requests\UpdatePiezaRequest;


class PiezaController extends Controller
{

    public function index(){
        $piezas = PiezaResource::collection(Pieza::paginate(7));
       return inertia('Piezas/Index', [
            'piezas' => $piezas,
       ]);
    }

    public function create(){
       //proveedores orderna por nombre ascendente
       $proveedores = ProveedorResource::collection(Proveedor::orderBy('nombre', 'asc')->get());
       return inertia('Piezas/Create', [
            'proveedores' => $proveedores,
       ]);
    }

    public function store(StorePiezaRequest $request){
        //vinculamos el usuario autenticado que ha creado la pieza
        
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        //creamos la pieza
        Pieza::create($data);
        return redirect()->route('piezas.index')->with('success', 'Pieza creada correctamente');
    }

    public function edit(Pieza $pieza){
        //obtenemos los proveedores
        $proveedores = ProveedorResource::collection(Proveedor::orderBy('nombre', 'asc')->get());
        $pieza = PiezaResource::make($pieza->load('user', 'proveedor'));
        return inertia('Piezas/Edit', [
            'pieza' => $pieza,
            'proveedores' => $proveedores,
        ]);
    }

    public function update(UpdatePiezaRequest $request, Pieza $pieza){
        $pieza->update($request->validated());
        return redirect()->route('piezas.index')->with('success', 'Pieza actualizada correctamente'); //actualizamos la pieza
    }

    public function destroy(Pieza $pieza){
        //modal de confirmación
        return inertia('Piezas/Delete', [
            'pieza' => PiezaResource::make($pieza->load('user', 'proveedor')),
        ]);        
    }
}
