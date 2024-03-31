@extends('master')
@section('titulo', "Eliminar Producto")
<link href="{{ asset('/css/styles_edit.css')}}" rel="stylesheet">
@section('body')
    <div id="alerta">
        <h2>Deseas eliminar el producto <p></p> "{{$producto->Nombre}}"</h2>
            <a href="{{ url('/') }}">
                <button type="button" class="btn btn-success delete_btn">NO</button>
            </a>
            <a href="{{ url('delete', [$producto->ProductoServicioID]) }}">
                <button type="button" class="btn btn-danger delete_btn">SI</button>
            </a>
    </div>
@endsection