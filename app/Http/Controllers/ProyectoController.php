<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProyectoRequest;
use App\Http\Resources\ProyectoResource;
use App\Models\Proyecto;
use DragonCode\Contracts\Cache\Store;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //listar los proyectos con estado activo
        $proyectos = ProyectoResource::collection(Proyecto::where('estado', 'activo')->paginate(7));
        return inertia('Proyectos/Index',[
            'proyectos' => $proyectos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Proyectos/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProyectoRequest $request)
    {
        $proyecto = $request->validated();

        Proyecto::create($proyecto);
        return redirect()->route('proyectos.index')->with('success', 'Proyecto creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyecto $proyecto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyecto $proyecto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto)
    {
        //no eliminamos, mantenemos el registro para el tema de graficos y analiticas
        $proyecto->estado = 'eliminado';
        $proyecto->save();
        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado correctamente');
    }
}
