<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formulario;

class FormularioController extends Controller
{
    public function index()
    {
        $formulario = Formulario::with('preguntas')->get();
        return view("formRese", compact('formulario'));
    }

    public function show($id)
    {
        return Formulario::find($id);
    }

    public function store(Request $request)
    {
        $formulario = new Formulario();
        $formulario->nombre = $request->get('nombre');
        $formulario->descripcion = $request->get('descripcion');
        $formulario->tipo = $request->get('tipo');
        $formulario->save();
        
        return view('/')->with('success', 'Formulario creado correctamente');
    }

    public function update(Request $request, $id)
    {
        $formulario = Formulario::findOrFail($id);
        $formulario->update($request->all());
        return $formulario;
    }

    public function delete($id)
    {
        $formulario = Formulario::findOrFail($id);
        $formulario->delete();
        return 204;
    }
}
