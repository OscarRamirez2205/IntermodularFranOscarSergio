<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        //dd($request);

        if(Auth::attempt(['email' => $request->username , 'password' => $request->password])){
            //dd(Auth::user());
            if(Auth::user()->role == 'admin'){
                return redirect()->intended(route("admin_cartas"));
            }

            if(Auth::user()->role == 'cliente'){
                return redirect()->intended(route("catalogo"));
            }
        }

        return redirect()->route('login')->with('error','Inicio de sesion fallido');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
