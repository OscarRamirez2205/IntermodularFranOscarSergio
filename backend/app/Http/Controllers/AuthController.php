<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $usuario = Auth::usuario();

            // Obtener roles del usuario
            $roles = $usuario->roles->pluck('nombre')->toArray();

            // Guardar roles en la sesión
            session(['roles' => $roles]);

            return response()->json(['usuario' => $usuario, 'roles' => $roles]);
        }

        return response()->json(['message' => 'Credenciales inválidas'], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Sesión cerrada']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'NIF' => 'required|string|unique:usuarios',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|string|min:8',
        ]);

        $usuario = new Usuario;
        $usuario->nombre = $request->nombre;
        $usuario->NIF = $request->NIF;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->id_centro = $request->id_centro; // Si es necesario
        $usuario->id_empresa = $request->id_empresa; // Si es necesario
        $usuario->save();

        // Asignar roles (opcional)
        // $usuario->roles()->attach($request->roles);

        return response()->json(['message' => 'Usuario registrado']);
    }
}
