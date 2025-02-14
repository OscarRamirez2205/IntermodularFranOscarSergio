<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PreguntasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $preguntas = Pregunta::all();
        return view('preguntas.index', compact('preguntas'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pregunta $pregunta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pregunta $pregunta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pregunta $pregunta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pregunta $pregunta)
    {
        //
    }
}
