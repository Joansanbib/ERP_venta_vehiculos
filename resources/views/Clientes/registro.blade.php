@extends('master')
@section('titulo', "Registrar cliente")
<link href="{{ asset('/css/styles_edit.css')}}" rel="stylesheet">
@section('body')

<h2 class="text-white">Registrar cliente</h2>
<form id="form" action="/clientes/create" method="post" class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
   @csrf
   <div class="mb-4">
      <label class="block text-black text-sm font-bold mb-2" for="cliente_name">Nombre:</label>
      <input type="text" name="cliente_name" id="cliente_name" placeholder="Nombre" required class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-4">
      <label class="block text-black text-sm font-bold mb-2" for="cliente_apellido">Apellidos:</label>
      <input type="text" name="cliente_apellido" id="cliente_apellido" placeholder="Apellidos" required class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-4">
      <label class="block text-black text-sm font-bold mb-2" for="cliente_email">Email:</label>
      <input type="text" name="cliente_email" id="cliente_email" placeholder="Email" required class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-4">
      <label class="block text-black text-sm font-bold mb-2" for="cliente_pass">Contraseña: </label>
      <input type="text" name="cliente_pass" id="cliente_pass" placeholder="Contraseña" required class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-4">
      <label class="block text-black text-sm font-bold mb-2" for="cliente_tel">Teléfono:</label>
      <input type="number" name="cliente_tel" id="cliente_tel" placeholder="Opcional" class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-4">
      <label class="block text-black text-sm font-bold mb-2" for="cliente_dir">Dirección:</label>
      <input type="text" name="cliente_dir" id="cliente_dir" placeholder="Opcional" class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-4">
      <label class="block text-black text-sm font-bold mb-2" for="cliente_pob">Población (nombre):</label>
      <input type="text" name="cliente_pob" id="cliente_pob" placeholder="Población" required class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-4">
    <label class="block text-black text-sm font-bold mb-2" for="rol">Rol:</label>
    <select name="rol" id="rol" required class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
        <option value="1">Administador</option>
        <option value="2">Cliente</option>
    </select>
</div>

   <div class="flex justify-center mb-4">
      <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded focus:outline-none mr-4" type="submit" id="editar_prod">Crear cliente</button>
   </div>
</form>

@endsection