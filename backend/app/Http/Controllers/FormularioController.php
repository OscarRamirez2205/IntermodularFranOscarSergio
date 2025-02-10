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
        return Formulario::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $formulario = Formulario::findOrFail($id);
        $formulario->update($request->all());
        return $formulario;
    }

    public function delete(Request $request, $id)
    {
        $formulario = Formulario::findOrFail($id);
        $formulario->delete();
        return 204;
    }
}
