<?php

namespace App\Http\Controllers;

use App\Models\resenya;
use App\Http\Controllers\Controller;
use App\Models\PreguntaFormulario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class ResenyaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Obtener todas las preguntas del formulario específico
        $formulario = PreguntaFormulario::where('id_formulario', $request->id_formulario)->get();
        
        foreach($formulario as $index => $pregunta){
            $valoracion = 'valoracion_' . ($index + 1);
            
            $resenya = new Resenya();
            $resenya->fecha_resena = now(); 
            $resenya->valoracion = $request->$valoracion;
            $resenya->id_pregunta_formulario = $pregunta->id;
            $resenya->save();
        }
        
        return response()->json(['message' => 'Reseñas guardadas correctamente'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(resenya $resenya)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(resenya $resenya)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, resenya $resenya)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(resenya $resenya)
    {
        //
    }
}
