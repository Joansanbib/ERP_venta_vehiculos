@extends('master')
@section('titulo', "Mi perfil")
<link href="{{ asset('/css/styles_edit.css')}}" rel="stylesheet">
@section('body')

@if (Session::has('error'))
    <script>
        var id = "{{ $id }}";
        console.log(id);
        Swal.fire({
            icon: 'warning',
            title: 'Advertencia',
            text: "{{ Session::get('error') }}",
            showCancelButton: true,
            confirmButtonText: 'Borrar cuenta',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
         console.log('1');
            if (result.isConfirmed) {
               console.log('2');
               $.ajax({
                    type: 'POST',
                    url: '/eliminar-cuenta/'+id, 
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        window.location.href='/login';
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                
            }
        });
    </script>
@endif

<form id="form" action="/perfil/update/{{$id}}" method="post" class="max-w-lg mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 m-10" >
   @csrf
   <div class="mb-7">
      <label class="block text-black text-lg font-bold mb-4" for="editName">Nombre:</label>
      <input type="text" name="editName" id="editName" placeholder="{{$nombre}}" class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-7">
      <label class="block text-black text-lg font-bold mb-4" for="editEmail">Email:</label>
      <input type="text" name="editEmail" id="editEmail" placeholder="{{$email}}" class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="mb-7">
      <label class="block text-black text-lg font-bold mb-4" for="editPass">Contraseña:</label>
      <input type="text" name="editPass" id="editPass" placeholder="{{$pass}}" class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>

   <div class="flex justify-center">
      <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded focus:outline-none mr-4" type="submit" id="editar_prod">Editar Perfil</button>
      <a href="/cerrar_sesion">
         <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded focus:outline-none mr-4" type="button" id="cerrar_sesion">Cerrar sesión</button>
      </a>
      <a href="/borrar_cuenta">
         <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded focus:outline-none mr-4" type="button" id="cerrar_sesion">Borrar cuenta</button>
      </a>
      
   </div>
</form>

@endsection