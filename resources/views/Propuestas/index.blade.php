@extends('master')
@section('titulo', 'Propuestas')
<!-- <link href="{{ asset('/css/styles_edit.css')}}" rel="stylesheet"> -->
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
        "",
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
            {
                name: 'Descargar',
                formatter: (cell, row) => {
                    // console.log(`Ruben ${JSON.stringify(row.cells[1].data)}`); 
                    
                    const array = [];
                    for (let i = 0; i < 7; i++) {
                        if (isNaN(row.cells[i].data)) {
                            array.push(`'${row.cells[i].data}'`);
                        } else {
                            array.push(row.cells[i].data);
                        }
                    }
                    return gridjs.html(`<img src="{{URL::asset('/img/pdf.png')}}" id="pdf-img" name="pdf-img" style="width: 25%; display: block; margin-left: auto; margin-right: auto;" onclick="generarPDF(${array})"/>`);

                    
                },
                
            }
            
        ],
        
        sort: true,
        pagination: true,
        search: true,
        width : '90%',
        data: <?php echo $grid_data_json; ?>
    }).render(document.getElementById('table_div'));
</script>
<script>
        function generarPDF(identificador, id, venta, cliente, fecha, estado, detalles) {
            let ifVenta;
            if (venta == 1){
                ifVenta = "venta";
            }
            else{
                ifVenta = "propuesta";
            }
            var val = htmlToPdfmake(`
            <style>
            *{
                font-family: Arial, Helvetica, sans-serif;
                font-size: 20px;
            }
            </style>
            <h1 style="text-align: center; text-decoration: underline;">INVOICE ${identificador}</h1>
            <br>
            <p>
                <h3 style="text-align: center; font-weight: 100;">La empresa hace reporte de la factura número ${id+1} como una ${ifVenta} con los siguientes datos:</h3>
            </p>
            <hr>
                <h3 style="text-align: center; font-style: italic; font-weight: 600;">Número de propuesta : </h3>
                <h3 style="text-align: center; font-weight: 100;">${id+1}</h3>    
                <h3 style="text-align: center; font-style: italic; font-weight: 600;">Identificador : </h3>         
                <h3 style="text-align: center; font-weight: 100;">${identificador}</h3> 
            <hr>
                <h3 style="text-align: center; font-style: italic; font-weight: 600;">Creado por el cliente : </h3>
                <h3 style="text-align: center; font-weight: 100;">${cliente}</h3>    
                <h3 style="text-align: center; font-style: italic; font-weight: 600;">En la fecha: </h3>         
                <h3 style="text-align: center; font-weight: 100;">${fecha}</h3> 
            <hr>
                <h3 style="text-align: center; font-style: italic; font-weight: 600;">Con estado : </h3>
                <h3 style="text-align: center; font-weight: 100;">${estado}</h3>    
                <h3 style="text-align: center; font-style: italic; font-weight: 600;">Con detalles : </h3>         
                <h3 style="text-align: center; font-weight: 100;">${detalles}</h3> 
            <hr>
            `);
            var dd = {content:val};
            pdfMake.createPdf(dd).download('factura.pdf');
        }
    </script>
@endsection