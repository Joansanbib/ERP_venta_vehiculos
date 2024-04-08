@extends('master')
@section('titulo', "Editar Cliente")
<link href="{{ asset('/css/styles_edit.css')}}" rel="stylesheet">
@section('body')

<form id="form" action="/clientes/{{$cliente->ClienteID}}/update" method="post" class="max-w-lg mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 m-10">
   @csrf
   <div class="mb-7">
      <label class="block text-black text-lg font-bold mb-4" for="editName">Nombre:</label>
      <input type="text" name="editName" id="editName" placeholder="{{$cliente->Nombre}}" class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-7">
      <label class="block text-black text-lg font-bold mb-4" for="editApellido">Apellido:</label>
      <input type="text" name="editApellido" id="editApellido" placeholder="{{$cliente->Apellido}}" class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-7">
      <label class="block text-black text-lg font-bold mb-4" for="editEmail">Email:</label>
      <input type="text" name="editEmail" id="editEmail" placeholder="{{$cliente->Email}}" class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-7">
      <label class="block text-black text-lg font-bold mb-4" for="editTel">Teléfono:</label>
      <input type="number" name="editTel" id="editTel" placeholder="{{$cliente->Teléfono}}" class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-7">
      <label class="block text-black text-lg font-bold mb-4" for="editDir">Dirección:</label>
      <input type="text" name="editDir" id="editDir" placeholder="{{$cliente->Dirección}}" class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-7">
      <label class="block text-black text-lg font-bold mb-4" for="editContra">Contraseña:</label>
      <input type="text" name="editContra" id="editContra" placeholder="{{$cliente->Contraseña}}" class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-7">
      <label class="block text-black text-lg font-bold mb-4" for="editPob">Población:</label>
      <input type="text" name="editPob" id="editPob" placeholder="{{$cliente->Nombre_poblacion}}" class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-7">
    <label class="block text-black text-lg font-bold mb-4" for="editRol">Rol:</label>
    <select name="editRol" id="editRol" required class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
        <option value="1">Administador</option>
        <option value="2">Cliente</option>
    </select>
   </div>
   <div class="flex justify-center">
      <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded focus:outline-none mr-4" type="submit" id="editar_prod">Editar Producto</button>
   </div>
</form>

@endsection