<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Centro;
use App\Models\Empresa;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::paginate(10);
        return view('usuarios', compact('usuarios'));
    }

    public function show($id)
    {
        return Usuario::find($id);
    }

    public function store(Request $request)
    {
        return Usuario::create($request->all());
    }

    public function edit(Usuario $usuario)
    {
        $centros = Centro::all();
        $empresas = Empresa::all();
        return view('formUsu', compact(['usuario', 'centros', 'empresas']));
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->nombre = $request->nombre;
        $usuario->NIF = $request->NIF;
        $usuario->email = $request->email;
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }
        $usuario->id_centro = $request->centros;
        $usuario->id_empresa = $request->empresas;
        $usuario->save();

        $usuario->roles()->sync($request->roles);


        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente');
    }

}
