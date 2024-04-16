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
    foreach ($productos_comprados as $row) {
        $arr[] = array(
            'Cliente' => $row->ClienteID,
            'Total' => $row->Total
        );
    }
    $chart_data = '';
    foreach ($arr as $row){
        $chart_data .= "{label: '" . $row['Cliente'] . "', value: " . $row['Total'] . "},";
        
    }

    foreach ($avg_preu_usuaris as $row) {
        $arr1[] = array(
            'Cliente' => $row->ClienteID,
            'Avg precio' => $row->average
        );
    }
    $chart_data1 = '';
    foreach ($arr1 as $row){
        $chart_data1 .= "{Cliente: '" . $row['Cliente'] . "', Avg precio: " . $row['Avg precio'] . "},";
        
    }

    // dd($chart_data1);
    // $grid_data = [];
    // foreach ($query as $row) {
    //     $grid_data[] = [
    //         $row->Nombre,
    //         $row->Stock
    //     ];
    // }

    // $grid_data_json = json_encode($grid_data);
    // dd($chart_data);
    // $chart_data = substr($chart_data, 0, -1);

?>
<div id="grafic">
    <div id="chart"></div>
    <div id="chart1"></div>
    <div id="table_div"></div>
    <div>
    <canvas id="myChart"></canvas>
    </div>
</div>
<script>
    Morris.Donut({
        element : 'chart',
        data : [<?php echo $chart_data; ?>],
        // parseTime: false,

    });
</script>
<script>
    Morris.Bar({
        element : 'chart1',
        data : [<?php echo $chart_data1; ?>],
        xkey: 'Cliente',
        ykeys: ['Avg precio'], 
        labels: ['Cliente'], 
        hideHover : 'auto',
        // parseTime: false,

    });
</script>
@endsection
