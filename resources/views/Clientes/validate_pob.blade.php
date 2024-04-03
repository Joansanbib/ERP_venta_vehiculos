@extends('master')
@section('titulo', "Validar población")
<link href="{{ asset('/css/styles_edit.css')}}" rel="stylesheet">
@section('body')

<script>
    var poblacion = "{{ $poblacion }}";
    var id = "{{ $id }}";
    buscarCodigoPostal(poblacion);

    function buscarCodigoPostal(poblacion) {
    const baseUrl = "http://api.geonames.org/postalCodeSearchJSON";

    const params = {
        placename: poblacion,
        country: "ES", 
        username: "Joansanbib", 
        maxRows: 1 
    };

    const url = new URL(baseUrl);
    url.search = new URLSearchParams(params).toString();
    console.log(url);

    fetch(url)
        .then(response => response.json())
        .then(data => {

            if (data.postalCodes.length > 0) {
                const codigoPostal = data.postalCodes[0].postalCode;
                const latitude = data.postalCodes[0].lat;
                const longitude = data.postalCodes[0].lng;
                const name = data.postalCodes[0].placeName;
                window.location.href = '/clientes/validate_pob?codigoPostal=' + encodeURIComponent(codigoPostal) 
                + '&id=' + encodeURIComponent(id) + '&lat=' + encodeURIComponent(latitude) 
                + '&lng=' + encodeURIComponent(longitude) + '&nombre=' + encodeURIComponent(name);
                
                
            } else {
                alert("No se ha encontrado el código postal español. Podrás editarlo cuando quieras desde tu perfil.");
                window.location.href = '/';
            }
        })
        .catch(error => {
            alert("No se ha encontrado el código postal español. Podrás editarlo cuando quieras desde tu perfil.");
            window.location.href = '/';
        });
}
</script>
@endsection