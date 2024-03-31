@extends('master')
@section('titulo', "Nuevo Producto")
<link href="{{ asset('/css/styles_edit.css')}}" rel="stylesheet">
@section('body')

<!-- <section id="edit">
    <form method="POST" action="/create">
        @csrf
        <div class="form-group">
        <div class="form-row">
            <label for="editName">Nombre</label>
            <input type="name" class="form-control" name="editName" placeholder="Nombre" required>
        </div>
        </div>
        <div class="form-group">
        <div class="form-row">
            <label for="editDesc">Descripción</label>
            <input type="name" class="form-control" name="editDesc" placeholder="Descripcion" required>
            </div>
        </div>
        <div class="form-group">
        <div class="form-row">
            <label for="editPrecio">Precio</label>
            <input type="name" class="form-control" name="editPrecio" placeholder="Precio" required>
            </div>
        </div>
        <div class="form-group">
        <div class="form-row">
            <label for="editStock">Stock</label>
            <input type="name" class="form-control" name="editStock" placeholder="Stock" required>
            </div>
        </div>
        <div class="form-group">
        <div class="form-row">
            <label for="fecha">Fecha de Entrada</label>
            <input type="date" class="form-control" name="fecha" placeholder="Fecha de Entrada" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Aplicar</button>
    </form>
</section> -->

<h2 class="text-white">Nuevo Producto</h2>
<form id="form" action="/create" method="post" class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
   @csrf
   <div class="mb-4">
      <label class="block text-black text-sm font-bold mb-2" for="editName">Nombre:</label>
      <input type="text" name="editName" id="editName" placeholder="Nombre" required class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-4">
      <label class="block text-black text-sm font-bold mb-2" for="editDesc">Descripción:</label>
      <input type="text" name="editDesc" id="editDesc" placeholder="Descripción" required class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-4">
      <label class="block text-black text-sm font-bold mb-2" for="editPrecio">Precio:</label>
      <input type="text" name="editPrecio" id="editPrecio" placeholder="Precio" required class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-4">
      <label class="block text-black text-sm font-bold mb-2" for="editStock">Stock:</label>
      <input type="text" name="editStock" id="editStock" placeholder="Stock" required class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-4">
      <label class="block text-black text-sm font-bold mb-2" for="fecha">Fecha de entrada:</label>
      <input type="date" name="fecha" id="fecha" placeholder="Fecha" required class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="flex justify-center mb-4">
      <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded focus:outline-none mr-4" type="submit" id="editar_prod">Crear Producto</button>
   </div>
</form>

@endsection