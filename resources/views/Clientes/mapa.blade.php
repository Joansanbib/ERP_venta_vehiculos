@extends('master')
@section('titulo', "Mapa Clientes")
<link href="{{ asset('/css/styles_edit.css')}}" rel="stylesheet">
@section('body')
<div id="map" style="height: 100%;"></div>

<script>
var map = L.map('map').setView([40.416775, -3.70379], 6);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

var usuarios = {!! json_encode($clientes) !!};

usuarios.forEach(function(usuario) {
    if (usuario.Poblacion != null && usuario.Poblacion != ''){
        var latitud = usuario.Latitud;
        var longitud = usuario.Longitud;
        L.marker([latitud, longitud]).addTo(map)
            .bindPopup('<p>Nombre completo: '+ usuario.Nombre + usuario.Apellido +
            '<br>Email: '+ usuario.Email);
            
    }
});

</script>
@endsection