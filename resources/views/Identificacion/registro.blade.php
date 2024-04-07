@extends('master')
@section('titulo', "Registro de usuario")
<link href="{{ asset('/css/styles_edit.css')}}" rel="stylesheet">
@section('body')

<h2 class="text-white">Registro de usuario</h2>
<form id="form" action="/registro/store" method="post" class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
   @csrf
   <div class="mb-4">
      <label class="block text-black text-sm font-bold mb-2" for="nombre">Nombre:</label>
      <input type="text" name="nombre" id="nombre" placeholder="Nombre" required class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-4">
      <label class="block text-black text-sm font-bold mb-2" for="email">Email:</label>
      <input type="text" name="email" id="email" placeholder="Email" required class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-4">
      <label class="block text-black text-sm font-bold mb-2" for="password">Contraseña: </label>
      <input type="text" name="password" id="password" placeholder="Contraseña" required class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <p class="text-gray-500 cursor-pointer" onclick="window.location.href='/login'">¿Ya tienes cuenta? Identifícate aquí.</p>
   <div class="flex justify-center mb-4">
      <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded focus:outline-none mr-4" type="submit" id="editar_prod">Registrarse</button>
   </div>
</form>

@endsection