<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pieza; 
use App\Http\Resources\PiezaResource;
use App\Http\Resources\BloqueResource;
use App\Models\Bloque;
use App\Http\Requests\StorePiezaRequest;
use App\Http\Requests\UpdatePiezaRequest;
use App\Models\Proyecto;
use App\Http\Resources\ProyectoResource;


class PiezaController extends Controller
{

    public function index(){
      $piezas = PiezaResource::collection(Pieza::paginate(7));
       return inertia('Piezas/Index', [
            'piezas' => $piezas,
       ]);
    }

    public function create(){
       //bloques ordenados por nombre ascendente
       $bloques = BloqueResource::collection(Bloque::orderBy('nombre', 'asc')->get());
       $proyectos = ProyectoResource::collection(Proyecto::orderBy('nombre', 'asc')->get());
       return inertia('Piezas/Create', [
            'bloques' => $bloques,
            'proyectos' => $proyectos,
       ]);
    }

    public function store(StorePiezaRequest $request){
        //vinculamos el usuario autenticado que ha creado la pieza
        
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        //codigo de la pieza 001,002
        $data['codigo'] = str_pad(Pieza::count() + 1, 3, '0', STR_PAD_LEFT);
        //creamos la pieza
        Pieza::create($data);
        return redirect()->route('piezas.index')->with('success', 'Pieza creada correctamente');
    }

    public function edit(Pieza $pieza){
        //obtenemos los bloques
        $bloques = BloqueResource::collection(Bloque::orderBy('nombre', 'asc')->get());
        $proyectos = ProyectoResource::collection(Proyecto::orderBy('nombre', 'asc')->get());
        $pieza = PiezaResource::make($pieza->load('user', 'bloque'));
        return inertia('Piezas/Edit', [
            'pieza' => $pieza,
            'bloques' => $bloques,
            'proyectos' => $proyectos,
        ]);
    }

    

    public function update(UpdatePiezaRequest $request, Pieza $pieza){
        $pieza->update($request->validated());
        return redirect()->route('piezas.index')->with('success', 'Pieza actualizada correctamente'); //actualizamos la pieza
    }

    public function destroy(Pieza $pieza){
        $pieza->delete();
        return redirect()->route('piezas.index')->with('success', 'Pieza eliminada correctamente');            
    }
}
