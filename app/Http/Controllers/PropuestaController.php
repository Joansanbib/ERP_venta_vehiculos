<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class PropuestaController extends Controller
{
    public function index(){
       
        $resultados = DB::select("select * from Venta_Propuestas");
        return view('Propuestas.index', ['propuestas' => $resultados]);

    }

    public function crear_propuesta(){

        $resultados = DB::select("select * from Clientes");
        return view('Propuestas.crear', ['clientes' => $resultados]);
    }

    public function store_propuesta(Request $request){
        $request->validate([
            'cliente' => 'integer', 
            'detalles' => 'string|max:400',
         ]);
     
         $resultado = [];
    
         $id = 0;
         $existen_elem = DB::select("select * from Venta_Propuestas");
         if (!empty($existen_elem) && !is_null($existen_elem)){
            $id = DB::table('Venta_Propuestas')
                ->select(DB::raw('MAX(ClienteID) + 1 AS NuevaID'))
                ->value('NuevaID');
         }
         $resultado["PropuestaID"] = $id;
         $cliente = $request->input('cliente');
         $resultado["ClienteID"] = $cliente;
         $fecha = Carbon::now()->toDateString();
         $resultado["FechaCreación"] = $fecha;
         $resultado["Estado"] = "Denegada";
         $detalles = $request->input('detalles');
         $resultado["Detalles"] = $detalles;
         $resultado["Venta"] = 0;
    
         DB::table('Venta_Propuestas')->insert($resultado);
        
        return redirect('/propuestas');
    }
    
    public function aceptar_propuesta($propuesta){
        $resultado = []; 
        $resultado["Estado"] = 'Aceptada';

        DB::table('Venta_Propuestas')
            ->where('PropuestaID', $propuesta) 
            ->update($resultado);

        return redirect('/propuestas');

    }
    public function crear_venta($propuesta){
        $productos = DB::select("select * from ProdcutosServicios");
        return view('Propuestas.venta', ['productos' => $productos, 'propuesta' => $propuesta]);
    }

    public function store(Request $request, $propuesta){
        $request->validate([
            'setCant' => 'numeric', 
            'setPrecio' => 'numeric',
         ]);
     
         $resultado = [];
         $stock_arr = [];
    
         $id = 0;
         $existen_elem = DB::select("select * from VentaDetalles");
         if (!empty($existen_elem) && !is_null($existen_elem)){
            $id = DB::table('VentaDetalles')
                ->select(DB::raw('MAX(DetalleVentaID) + 1 AS NuevaID'))
                ->value('NuevaID');
         }
         $resultado["DetalleVentaID"] = $id;
         $resultado["PropuestaID"] = $propuesta;
         $producto = $request->input('setProducto');
         $resultado["ProductoServicioID"] = $producto;
         $cantidad = $request->input('setCant');
         $resultado["CantidadVendidad"] = $cantidad;
         $precio = $request->input('setPrecio');
         $resultado["PrecioUnitario"] = $precio;
         
         $stock = DB::table('ProdcutosServicios')->where('ProductoServicioID', $producto)->value('Stock');
         $stock_arr["Stock"] = $stock - $cantidad;
         if ($stock - $cantidad < 0){
            Session::flash('error', 'La cantidad excede el stock disponible.');
            return Redirect::back();
         }
         else{
            DB::table('ProdcutosServicios')
            ->where('ProductoServicioID', $producto) 
            ->update($stock_arr);

            DB::table('Venta_Propuestas')
            ->where('PropuestaID', $propuesta) 
            ->update(["Venta" => 1]);
         }

         
         DB::table('VentaDetalles')->insert($resultado);
        
        return redirect('/propuestas');
    }
}
?>