<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
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
            Session::flash('error', 'Contraseña incorrecta.');
            return Redirect::back();
         }

    }
    public function edit_perfil(){
        $user = Auth::user();

        $id = $user->id;
        $nombre = $user->name;
        $email = $user->email;
        $password = $user->password;

        return view('Identificacion.edit_perfil', ['nombre' => $nombre, 'email' => $email, 'pass' => $password, 'id' => $id]);

    }
    public function perfil_update(Request $request, $user){
        $request->validate([
            'nombre' => 'string|max:255', 
            'email' => 'string|max:255', 
            'password' => 'string|max:255', 
         ]);
     
         $resultado = [];
     
         $nombre = $request->input('editName');
         if(!is_null($nombre)){
             $resultado["name"] = $nombre;
         }
     
         $email = $request->input('editEmail');
         if(!is_null($email)){
             $resultado["email"] = $email;
         }
     
         $password = $request->input('editPass');
         if(!is_null($password)){
             $resultado["password"] = $password;
         }
     
         if (!empty($resultado)) {
             DB::table('users')
                 ->where('id', $user) 
                 ->update($resultado);
         }
         
         return redirect('/');
    }
    public function cerrar_sesion(){
        Auth::logout();
        return redirect('login');
    }
    public function borrar_cuenta(){
        Session::flash('error', 'Seguro que quieres borrar tu cuenta?');
        return Redirect::back();
    }
    public function eliminarCuenta(Request $request, $id) {
        // Buscar al usuario por su ID
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect('login');
        }
    }
}
