@extends('master')
@section('titulo', 'Propuestas')
<link href="{{ asset('/css/styles_edit.css')}}" rel="stylesheet">
@section('body')
<?php
use Illuminate\Support\Facades\DB;

$grid_data = [];
foreach ($propuestas as $propuesta) {
    $id_cliente = $propuesta->ClienteID;
    $cliente = DB::table('Clientes')->where('ClienteID', $id_cliente)->value('Email');

    $propuestas_cliente = DB::select("select * from Venta_Propuestas where ClienteID = :ClienteID", ['ClienteID' => $id_cliente]);
    $cont = 1;
    foreach($propuestas_cliente as $row){
        if ($row->PropuestaID == $propuesta->PropuestaID){
            break;
        }
        else{
            $cont++;
        }
    }
    $identificador = $id_cliente . "/" . str_replace('-', '', $propuesta->FechaCreación) . "/" . $cont;

    $grid_data[] = [
        $identificador,
        $propuesta->PropuestaID,
        $propuesta->Venta,
        $cliente,
        $propuesta->FechaCreación,
        $propuesta->Estado,
        $propuesta->Detalles,
    ];
}

$grid_data_json = json_encode($grid_data);

?>
<div id="btn-section">
<a href="/propuestas/create">
    <button class="bg-blue-500 hover:bg-blue-600 text-white py-6 px-8 rounded focus:outline-none mr-5" type="submit" id="btn">CREAR PROPUESTA</button>
</a>
</div>
<div id="table_div"></div>
<script type="module">

    const grid = new gridjs.Grid({
        columns: [
            'Identificador',
            { 
                name: 'id',
                hidden: true
            },
            { 
                name: 'venta',
                hidden: true
            },
            'Cliente',
            'Fecha Creación',
            {
                name : 'Estado',
                formatter: (cell, row) => {
                    var estadoBtn;
                    if (row.cells[5].data == 'Aceptada'){
                        estadoBtn = gridjs.h('button', {
                            className: 'py-2 mb-4 px-4 border rounded-md text-white bg-green-600',
                        }, 'Aceptada');
                    }
                    else {
                        estadoBtn = gridjs.h('button', {
                            className: 'py-2 mb-4 px-4 border rounded-md text-white bg-red-600',
                        }, 'Denegada');
                    }
                    return [estadoBtn];
                }
                
                 
            },
            'Detalles',
            {
                formatter: (cell, row) => {
                    if(row.cells[5].data == 'Aceptada' && (row.cells[2].data == 0 || row.cells[2].data == null)){
                        const convertirBtn = gridjs.h('button', {
                        className: 'py-2 mb-4 px-4 border rounded-md text-white bg-blue-600',
                        onClick: () => {
                            window.location.href = `/propuestas/${row.cells[1].data}/venta`;
                        }
                        }, 'Convertir a venta');

                        return [convertirBtn];
                    }
                    else if(row.cells[5].data == 'Aceptada' && row.cells[2].data == 1){
                        const convertirBtn = gridjs.h('button', {
                        className: 'py-2 mb-4 px-4 border rounded-md text-white bg-green-600',
                        }, 'Contabilizada');

                        return [convertirBtn];
                    }
                    else if(row.cells[5].data == 'Denegada'){
                        const convertirBtn = gridjs.h('button', {
                        className: 'py-2 mb-4 px-4 border rounded-md text-white bg-blue-600',
                        onClick: () => {
                            window.location.href = `/propuestas/${row.cells[1].data}/aceptar`;
                        }
                        }, 'Aceptar propuesta');

                        return [convertirBtn];
                    }
                }
            },
            
        ],
        sort: true,
        pagination: true,
        search: true,
        width : '90%',
        data: <?php echo $grid_data_json; ?>
    }).render(document.getElementById('table_div'));
</script>
@endsection