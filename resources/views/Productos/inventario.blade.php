@extends('master')
@section('titulo', "Inventario")
<link href="{{ asset('/css/styles_edit.css')}}" rel="stylesheet">
@section('body')
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
</style>
<?php
    foreach ($query as $row) {
        $arr[] = array(
            'nombre' => $row->Nombre,
            'stock' => $row->Stock
        );
    }
    $chart_data = '';
    foreach ($arr as $row){
        $chart_data .= "{nombre: '" . $row['nombre'] . "', stock: " . $row['stock'] . "},";
        
    }
    $grid_data = [];
    foreach ($query as $row) {
        $grid_data[] = [
            $row->Nombre,
            $row->Stock
        ];
    }

    $grid_data_json = json_encode($grid_data);
    // dd($chart_data);
    // $chart_data = substr($chart_data, 0, -1);

?>
<div id="grafic">
    <div id="chart"></div>
    <div id="table_div"></div>
</div>
<script>
    Morris.Bar({
        element : 'chart',
        data : [<?php echo $chart_data; ?>],
        xkey: 'nombre',
        ykeys: ['stock'], 
        labels: ['Stock'], 
        hideHover : 'auto',
        // parseTime: false,

    });
</script>
<script type="module">

    document.addEventListener("DOMContentLoaded", function() {
        const grid = new gridjs.Grid({
            columns: [
                'Nombre',
                'Stock'
            ],
            sort: true,
            pagination: true,
            search: true,
            width : '90%',
            data: <?php echo $grid_data_json; ?>
        }).render(document.getElementById('table_div'));;
    });
</script>
<script>
    alert("¡Hola! Esto es una alerta en JavaScript.");
</script>
@endsection
