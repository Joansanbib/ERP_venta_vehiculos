@extends('master')
@section('titulo', "Editar Producto")
<link href="{{ asset('/css/styles_edit.css')}}" rel="stylesheet">
@section('body')

<h2 class="text-white">Editar Producto</h2>
<form id="form" action="/producto/{{$producto->ProductoServicioID}}/update" method="post" class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
   @csrf
   <div class="mb-4">
      <label class="block text-black text-sm font-bold mb-2" for="editName">Nombre:</label>
      <input type="text" name="editName" id="editName" placeholder="{{$producto->Nombre}}" class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-4">
      <label class="block text-black text-sm font-bold mb-2" for="editDesc">Descripción:</label>
      <input type="text" name="editDesc" id="editDesc" placeholder="{{$producto->Descripcion}}" class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-4">
      <label class="block text-black text-sm font-bold mb-2" for="editPrecio">Precio:</label>
      <input type="text" name="editPrecio" id="editPrecio" placeholder="{{$producto->Precio}}" class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-4">
      <label class="block text-black text-sm font-bold mb-2" for="editStock">Stock:</label>
      <input type="text" name="editStock" id="editStock" placeholder="{{$producto->Stock}}" class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="flex justify-center mb-4">
      <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded focus:outline-none mr-4" type="submit" id="editar_prod">Editar Producto</button>
   </div>
</form>

@endsection