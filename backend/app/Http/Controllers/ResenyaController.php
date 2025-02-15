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
        $formulario = PreguntaFormulario::all()->where('id_formulario', $request->get('id_formulario'));
        $num = 1;
        foreach($formulario as $preguntas){
            $valoracion = 'valoracion_'. $num;
            $resenya = new Resenya();
            $resenya->fecha_resena = Date('dd/mm/YYYY');
            $resenya->valoracion = $request->get($valoracion);
            $resenya->id_pregunta_formulario = $preguntas->id;
            $resenya->save();
            $num++;
        }
        
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
