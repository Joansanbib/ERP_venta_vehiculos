@extends('master')
@section('titulo', "Clientes")
<link href="{{ asset('/css/styles_edit.css')}}" rel="stylesheet">
@section('body')

<?php

$grid_data = [];
foreach ($clientes as $cliente) {
    $tipoCliente = ($cliente->TipoClienteID == 1) ? 'Admin' : 'Cliente';
    $codi_postal = $cliente->Poblacion;

    $grid_data[] = [
        $cliente->ClienteID,
        $cliente->Nombre,
        $cliente->Apellido,
        $cliente->Email,
        $cliente->Nombre_poblacion,
        $tipoCliente,
    ];
}

$grid_data_json = json_encode($grid_data);

?>
<style>
#table_div{
    display:flex;
    justify-content:center; 
}
#table_div td{
    text-align: center;
}
#table_div tr{
    text-align : center;
}
.button-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px; /* Ajusta el margen según sea necesario */
}
#btn-newElement{
  width: 100px;
  height: 100px;
}

</style>
<div id="btn-section">
<a href="/clientes/registro">
    <button class="bg-blue-500 hover:bg-blue-600 text-white py-6 px-8 rounded focus:outline-none mr-5" type="submit" id="btn">REGISTRAR CLIENTE</button>
</a>
<a href="/clientes/mapa">
    <button class="bg-blue-500 hover:bg-blue-600 text-white py-6 px-8 rounded focus:outline-none mr-5" type="submit" id="btn">UBICACIÓN CLIENTES</button>
</a>
</div>
<div id="table_div"></div>
<script type="module">

    const grid = new gridjs.Grid({
        columns: [
            { 
                name: 'id',
                hidden: true
            },
            'Nombre',
            'Apellido',
            'Email',
            'Población',
            'Rol',
            {
                formatter: (cell, row) => {
                    const editarButton = gridjs.h('button', {
                        className: 'py-2 mb-4 px-4 border rounded-md text-white bg-blue-600',
                        onClick: () => {
                            window.location.href = `/clientes/${row.cells[0].data}/edit`;
                        }
                    }, 'Editar');

                    const eliminarButton = gridjs.h('button', {
                        className: 'py-2 mb-4 px-4 border rounded-md text-white bg-red-600',
                        onClick: () => {
                          var resultado = window.confirm("Seguro que quieres eliminar este registro?");
                            if(resultado){
                              window.location.href = `/clientes/delete/${row.cells[0].data}`;
                            }
                        }

                    }, 'Eliminar');

                    return [editarButton, eliminarButton];
                }
            },
            
        ],
        sort: false,
        pagination: true,
        search: true,
        width : '90%',
        data: <?php echo $grid_data_json; ?>
    }).render(document.getElementById('table_div'));
</script>
@endsection