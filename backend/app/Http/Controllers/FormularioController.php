<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Models\Formulario;
use App\Models\PreguntaFormulario;
use App\Models\Token;
use App\Models\Pregunta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $empresas = Empresa::paginate(10);
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

    public function getPreguntasByToken($token)
    {
        Log::info('Token recibido:', ['token' => $token]);

        try {
            // 1. Primero verificamos si el formulario existe
            $formulario = DB::table('formularios')
                ->where('id_token', $token)
                ->first();

            if (!$formulario) {
                Log::warning('Formulario no encontrado:', ['token' => $token]);
                return response()->json([
                    'message' => 'Formulario no encontrado',
                    'token' => $token
                ], 404);
            }

            Log::info('Formulario encontrado:', ['formulario_id' => $formulario->id]);

            // 2. Obtenemos las preguntas
            $preguntas = DB::table('preguntas AS p')
                ->join('preguntaformulario AS pf', 'p.id', '=', 'pf.id_pregunta')
                ->join('formularios AS f', 'pf.id_formulario', '=', 'f.id')
                ->where('f.id', $formulario->id) // Cambiado para usar el ID del formulario
                ->select(
                    'p.id',
                    'p.pregunta as question',
                    'p.tipo as type',
                    'pf.id as pregunta_formulario_id'
                )
                ->get();

            Log::info('Consulta SQL:', [
                'query' => DB::getQueryLog(),
                'numero_preguntas' => $preguntas->count()
            ]);

            if ($preguntas->isEmpty()) {
                Log::warning('No se encontraron preguntas para el formulario');
                return response()->json([
                    'message' => 'No hay preguntas asociadas a este formulario'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $preguntas
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error en getPreguntasByToken:', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            return response()->json([
                'message' => 'Error al obtener las preguntas',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
