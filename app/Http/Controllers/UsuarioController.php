<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class UsuarioController extends Controller
{
    public function crear_registro(){
        return view('Identificacion.registro');

    }
    public function store_registro(Request $request){
        $request->validate([
            'nombre' => 'string|max:255', 
            'email' => 'string|max:255', 
            'password' => 'string|max:255', 
         ]);

         $resultado = [];

         $nombre = $request->input('nombre');
         $resultado["name"] = $nombre;
         $email = $request->input('email');
         $resultado["email"] = $email;
         $password = $request->input('password');
         $resultado["password"] = $password;
         

         DB::table('users')->insert($resultado);
         return redirect('/');
    }
    public function login_view(){
        return view('Identificacion.login');

    }
    public function login(Request $request){
        $request->validate([
            'email' => 'string|max:255', 
            'password' => 'string|max:255', 
         ]);
         $email = $request->input('email');
         $password = $request->input('password');

         $userData = DB::table('users')->where('email', $email)->where('password', $password)->first();

         if (!is_null($userData)){
            $user = new User();
            $user->id = $userData->id;
            $user->name = $userData->name;
            $user->email = $userData->email;

            Auth::login($user);
            return redirect('/');
         }
         else{
            return redirect('/login');
         }

    }
}
