<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create(){
        return view('auth.login');
    }

    public function login(Request $request){
        //dd($request->all()); die();
        if (auth()->attempt(request(['username','password'])) == false ) {
            return back()->withErrors([
                'message' => 'Datos Incorrectos, Intente de Nuevo!',
            ]);
        }
        //alert()->success('Sessión Exitosa','Bienvenido al Portal')->autoclose(2000);
        return redirect()->route('main.index');
    }

    public function destroy(){
        Session::flush();
        Auth::logout();
        return redirect()->route('welcome.index');
    }
}
