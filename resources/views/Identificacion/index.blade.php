@extends('master')
@section('titulo', "Gestión de usuarios")
<link href="{{ asset('/css/styles.css')}}" rel="stylesheet">
@section('body')
<?php

    $grid_data = [];
    foreach ($usuarios as $usuario) {
        $grid_data[] = [
            $usuario->id,
            $usuario->name,
            $usuario->email,
            $usuario->password,
           
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
<div id="table_div"></div>
<script type="module">
    
        const grid = new gridjs.Grid({
            columns: [
                'Id',
                'Nombre',
                'Email',
                'Contraseña',
                {
                    formatter: (cell, row) => {
                        const editarButton = gridjs.h('button', {
                            className: 'py-2 mb-4 px-4 border rounded-md text-white bg-blue-600',
                            onClick: () => {
                                window.location.href = `/usuario/${row.cells[0].data}/edit`;
                            }
                        }, 'Editar');

                        return [editarButton];
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

