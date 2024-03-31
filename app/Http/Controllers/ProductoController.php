<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
/**
* Display a listing  of the resource.
*/
public function index()
{
$resultados = DB::select("select * from ProdcutosServicios");
return view('Productos.pag_productos', ['productos' => $resultados]);

}

/**
* Show the form for creating a new resource.
*/
public function create()
{
    return view('Productos.nuevo_producto');
}

/**
* Store a newly created resource in storage.
*/
public function store(Request $request)
{
    $request->validate([
        'editName' => 'string|max:50', 
        'editDesc' => 'string|max:120', 
        'editPrecio' => 'numeric|regex:/^\d{1,18}$/',
        'editStock' =>  'integer'
     ]);
 
     $resultado = [];

     $id = 0;
     $existen_elem = DB::select("select * from ProdcutosServicios");
     if (!is_null($existen_elem)){
        $id = DB::table('ProdcutosServicios')
            ->select(DB::raw('MAX(ProductoServicioID) + 1 AS NuevaID'))
            ->value('NuevaID');
     }
     $resultado["ProductoServicioID"] = $id;
     $nombre = $request->input('editName');
     $resultado["Nombre"] = $nombre;
     $desc = $request->input('editDesc');
     $resultado["Descripcion"] = $desc;
     $precio = $request->input('editPrecio');
     $resultado["Precio"] = $precio;
     $stock = $request->input('editStock');
     $resultado["Stock"] = $stock;
     $fecha = $request->input('fecha');
     $resultado["FechaEntrada"] = $fecha;


     DB::table('ProdcutosServicios')->insert($resultado);
    
    return redirect('/');
}

/**
* Display the specified resource.
*/
public function show()
{   
    $resultados = DB::select("select * from ProdcutosServicios");
    return view('Productos.inventario', ['query' => $resultados]);
}

/**
* Show the form for editing the specified resource.
*/
public function edit($producto)
{
    $resultado = DB::table('ProdcutosServicios')->where('ProductoServicioID', $producto)->first();
    return view('Productos.edit_producto', ['producto' => $resultado]);
}


/**
* Update the specified resource in storage.
*/
public function update(Request $request, $producto)
{
    // $validacion = [
    //    'Nombre' => 'string|max:50', 
    //    'Descripcion' => 'string|max:120', 
    //    'Precio' => 'numeric|regex:/^\d{1,18}$/',
    //    'Stock' =>  'integer'
    // ];
    $request->validate([
       'editName' => 'string|max:50', 
       'editDesc' => 'string|max:120', 
       'editPrecio' => 'numeric|regex:/^\d{1,18}$/',
       'editStock' =>  'integer'
    ]);

    $resultado = [];

    $nombre = $request->input('editName');
    if(!is_null($nombre)){
        $resultado["Nombre"] = $nombre;
    }

    $desc = $request->input('editDesc');
    if(!is_null($desc)){
        $resultado["Descripcion"] = $desc;
    }

    $precio = $request->input('editPrecio');
    if(!is_null($precio)){
        $resultado["Precio"] = $precio;
    }

    $stock = $request->input('editStock');
    if(!is_null($stock)){
        $resultado["Stock"] = $stock;
    }

    // dd($resultado["Nombre"]);

    // $arr = [];

    // foreach ($valores as $campo => $valor) {
    //     if (array_key_exists($campo, $validacion)) {
    //         $arr[$campo] = $valor;
    //     }
    // }

    if (!empty($resultado)) {
        DB::table('ProdcutosServicios')
            ->where('ProductoServicioID', $producto) 
            ->update($resultado);
    }
    
    return redirect('/');


}

/**
* Remove the specified resource from storage.
*/
// public function delete_alert($producto){
//     $resultado = DB::table('ProdcutosServicios')->where('ProductoServicioID', $producto)->first();
//     return view('Productos.delete_product', ['producto' => $resultado]);

// }
public function destroy($producto)
{
    DB::table('ProdcutosServicios')->where('ProductoServicioID', $producto)->delete();
    return redirect('/');
}
}
