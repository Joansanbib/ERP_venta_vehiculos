@extends('master')
@section('titulo', "Registro de usuario")
<link href="{{ asset('/css/styles_edit.css')}}" rel="stylesheet">
@section('body')

<form id="form" action="/registro/store" method="post" class="max-w-lg mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 m-10">
   @csrf
   <div class="mb-7">
      <label class="block text-black text-lg font-bold mb-4" for="nombre">Nombre:</label>
      <input type="text" name="nombre" id="nombre" placeholder="Nombre" required class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-7">
      <label class="block text-black text-lg font-bold mb-4" for="email">Email:</label>
      <input type="text" name="email" id="email" placeholder="Email" required class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-7">
      <label class="block text-black text-lg font-bold mb-4" for="password">Contraseña: </label>
      <input type="password" name="password" id="password" placeholder="Contraseña" required class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-7">
      <label class="block text-black text-lg font-bold mb-4" for="rol">Rol: </label>
      <select name="rol" id="rol" required class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
         <option value="Cliente">Cliente</option>
         <option value="Admin">Admin</option>
      </select>
   </div>
   <p class="text-gray-500 cursor-pointer mb-4 text-center" onclick="window.location.href='/login'">¿Ya tienes cuenta? Identifícate aquí.</p>
   <div class="flex justify-center">
      <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded focus:outline-none mr-4" type="submit" id="editar_prod">Registrarse</button>
   </div>
</form>

@endsection