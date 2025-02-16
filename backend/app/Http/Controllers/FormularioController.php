<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
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

    public function show(Request $request)
    {
        return Formulario::find($request->get('token'));
    }

    public function store(Request $request)
    {
        // Creación del token para empresa
        $token = new Token();
        $token->token = $token->createToken('token_form');
        $token->save();

        // Creación del token para alumno
        $token_a = new Token();
        $token_a->token = $token_a->createToken('token_form');
        $token_a->save();

        // Creación del formulario de empresa
        $formulario = new Formulario();
        $formulario->nombre = $request->get('nombre');
        $formulario->definicion = 'Formulario para la empresa '.$request->get('nombre');
        $formulario->tipo = 'empresa';
        $formulario->id_token = $token['id'];
        $formulario->save();

        // Creación del formulario del alumno
        $formulario_a = new Formulario();
        $formulario_a->nombre = 'Alumno de '.$request->get('nombre');
        $formulario_a->definicion = 'Formulario para el alumno de la empresa '.$request->get('nombre');
        $formulario_a->tipo = 'alumno';
        $formulario_a->id_token = $token_a['id'];
        $formulario_a->save();

        // Asignación de las preguntas del formulario de la empresa (order = 1)
        $preguntas = Pregunta::All()->where('order', 1);
        foreach($preguntas as $pregunta){
            $pregunta_formulario = new PreguntaFormulario();
            $pregunta_formulario->id_formulario = $formulario['id'];
            $pregunta_formulario->id_pregunta = $pregunta['id'];
            $pregunta_formulario->save();
        }

        // Asignación de las preguntas del formulario del alumno (order = 2)
        $preguntas_a = Pregunta::All()->where('order', 2);
        foreach($preguntas_a as $pregunta){
            $pregunta_formulario = new PreguntaFormulario();
            $pregunta_formulario->id_formulario = $formulario_a['id'];
            $pregunta_formulario->id_pregunta = $pregunta['id'];
            $pregunta_formulario->save();
        }
        $empresas = Empresa::all();
        return view('/empresas', compact(['empresas', 'token', 'token_a']))->with('success', 'Formularios creados correctamente');
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
