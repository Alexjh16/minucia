<?php

namespace App\Http\Controllers;

use App\Models\Bloque;
use Illuminate\Http\Request;

use App\Http\Resources\BloqueResource;
use App\Http\Resources\ProyectoResource;
use App\Http\Requests\StoreBloqueRequest;
use App\Models\Proyecto;
use LaravelLang\Publisher\Console\Update;
use App\Http\Requests\UpdateBloqueRequest;

class BloqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //bloques con proyectos with pagination
        $bloques = BloqueResource::collection(
            Bloque::with('proyecto')
                ->orderBy('id', 'asc')
                ->paginate(7)
        );
        return inertia('Bloques/Index', [
            'bloques' => $bloques,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proyectos = ProyectoResource::collection(Proyecto::orderBy('id', 'asc')->get());
        return inertia('Bloques/Create', [
            'proyectos' => $proyectos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBloqueRequest $request)
    {
        $bloque = $request->validated();

        Bloque::create($bloque);
        return redirect()->route('bloques.index')->with('success', 'Bloque creado correctamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(Bloque $bloque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bloque $bloque)
    {
        $bloque = BloqueResource::make($bloque);
        $proyectos = ProyectoResource::collection(Proyecto::orderBy('id', 'asc')->get());
        return inertia('Bloques/Edit', [
            'bloque' => $bloque,
            'proyectos' => $proyectos,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBloqueRequest $request, Bloque $bloque)
    {
        $bloque->update($request->validated());
        return redirect()->route('bloques.index')->with('success', 'Bloque actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bloque $bloque)
    {
        $bloque->delete();
        return redirect()->route('bloques.index')->with('success', 'Bloque eliminado correctamente');
    }
}
