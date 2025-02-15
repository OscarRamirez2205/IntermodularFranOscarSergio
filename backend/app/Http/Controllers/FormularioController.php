<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formulario;
use App\Models\PreguntaFormulario;
use App\Models\Token;
use App\Models\Pregunta;

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
        $token = new Token();
        $token->token = $request->get('token_empresa');
        $token->save();

        $token_a = new Token();
        $token_a->token = $request->get('token_alumno');
        $token->save();

        //Creacion del formulario de empresa
        $formulario = new Formulario();
        $formulario->nombre = $request->get('nombre');
        $formulario->descripcion = $request->get('descripcion');
        $formulario->tipo = $request->get('tipo');
        $formulario->token = $token['id'];
        $formulario->save();

        //Creacion del formulario del alumno
        $formulario_a = new Formulario();
        $formulario_a->nombre = $request->get('nombre');
        $formulario_a->descripcion = $request->get('descripcion');
        $formulario_a->tipo = $request->get('tipo');
        $formulario_a->token = $token_a['id'];
        $formulario_a->save();

        //Asignacion de las preguntas del formulario de la empresa
        $preguntas = Pregunta::All()->where('order', 1);
        foreach($preguntas as $pregunta){
            $pregunta_formulario = new PreguntaFormulario();
            $pregunta_formulario->id_formulario = $formulario['id'];
            $pregunta_formulario->id_pregunta = $pregunta['id'];
            $pregunta_formulario->save();
        }

        //Asignacion de las preguntas del formulario del alumno
        $preguntas_a = Pregunta::All()->where('order', 2);
        foreach($preguntas_a as $pregunta){
            $pregunta_formulario = new PreguntaFormulario();
            $pregunta_formulario->id_formulario = $formulario_a['id'];
            $pregunta_formulario->id_pregunta = $pregunta['id'];
            $pregunta_formulario->save();
        }
        
        return view('/')->with('success', 'Formularios creados correctamente');
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
