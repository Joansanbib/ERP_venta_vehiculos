<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function index(){
        $clientes = DB::select("select * from Clientes");
        return view('Clientes.index', ['clientes' => $clientes]);
    }
    public function registro(){
        return view('Clientes.registro');
    }

    public function store(Request $request){
        $request->validate([
            'cliente_name' => 'string|max:50', 
            'cliente_apellido' => 'string|max:50', 
            'cliente_email' => 'string|max:100', 
            'cliente_tel' =>  'nullable|numeric',
            'cliente_pass' => 'string|max:50', 
            'cliente_dir' => 'nullable|string|max:120',
            'cliente_pob' =>  'string|max:120',
         ]);

         $resultado = [];

         $id = 0;
         $existen_elem = DB::select("select * from Clientes");
         if (!empty($existen_elem) && !is_null($existen_elem)){
            $id = DB::table('Clientes')
                ->select(DB::raw('MAX(ClienteID) + 1 AS NuevaID'))
                ->value('NuevaID');
         }
         $resultado["ClienteID"] = $id;
         $nombre = $request->input('cliente_name');
         $resultado["Nombre"] = $nombre;
         $apellido = $request->input('cliente_apellido');
         $resultado["Apellido"] = $apellido;
         $email = $request->input('cliente_email');
         $resultado["Email"] = $email;
         if (!is_null($request->input('cliente_tel'))){
            $tel = $request->input('cliente_tel');
            $resultado["Teléfono"] = $tel;
         }
         $pass = $request->input('cliente_pass');
         $resultado["Contraseña"] = $pass;
         $rol = $request->get('rol');
         $resultado["TipoClienteID"] = $rol;
         if (!is_null($request->input('cliente_dir'))){
            $dir = $request->input('cliente_dir');
            $resultado["Dirección"] = $dir;
         }
         $resultado["Poblacion"] = " ";
         $poblacion = $request->input('cliente_pob');

         DB::table('Clientes')->insert($resultado);
         return view('Clientes.validate_pob', compact('poblacion', 'id'));

         
    }

    public function api_geocode(Request $request){
        $codigoPostal = $request->input('codigoPostal');
        $id = $request->input('id');
        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $nombre = $request->input('nombre');

        DB::update("UPDATE Clientes SET Poblacion = ?, Latitud = ?, Longitud = ?, 
        Nombre_poblacion = ? WHERE ClienteID = ?", [$codigoPostal, $lat, $lng, $nombre, $id]);
        return redirect('/');

    }

    public function mapa(){
        $clientes = DB::select("select * from Clientes");
        return view('Clientes.mapa', ['clientes' => $clientes]);
    }
    

}
