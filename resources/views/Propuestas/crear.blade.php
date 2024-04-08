@extends('master')
@section('titulo', 'Crear propuesta')
<link href="{{ asset('/css/styles_edit.css')}}" rel="stylesheet">
@section('body')
<h2 class="text-white">Nueva Propuesta</h2>
<form id="form" action="/propuestas/store" method="post" class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
   @csrf
   <div class="mb-4">
      <label class="block text-black text-sm font-bold mb-2" for="cliente">Cliente:</label>
      <div class="relative">
      <select name="cliente" id="cliente" class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500" required>
            @foreach($clientes as $cliente)
                <option value="{{$cliente->ClienteID}}">{{$cliente->Email}}</option>
            @endforeach
      </select>
      <!-- <input type="text" name="cliente" id="cliente" placeholder="Cliente" required class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500"> -->
      <button type="button" class="absolute right-0 top-0 bottom-0 px-3 bg-gray-200" onclick="openModal()">Seleccionar Cliente</button>
      </div>
   </div>
   <div class="mb-4">
      <label class="block text-black text-sm font-bold mb-2" for="detalles">Detalles:</label>
      <input type="text" name="detalles" id="detalles" placeholder="Detalles" required class="py-2 px-3 border border-gray-300 rounded-md w-full focus:outline-none focus:border-indigo-500">
   </div>
   <div class="flex justify-center mb-4">
      <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded focus:outline-none mr-4" type="submit" id="editar_prod">Crear propuesta</button>
   </div>
 
 
</form>
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h3>Seleccionar Producto</h3>
        <input type="text" id="searchInput" onkeyup="searchProduct()" placeholder="Buscar cliente...">
        <div class="table-container">
            <table id="productTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                        <tr>
                            <td>{{$cliente->ClienteID}}</td>
                            <td><a href="#" onclick="selectProducto('{{$cliente->ClienteID}}', '{{$cliente->Nombre}}')">{{$cliente->Nombre}}</a></td>
                            <td>{{$cliente->Apellido}}</td>
                            <td>{{$cliente->Email}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function openModal() {
    document.getElementById('myModal').style.display = "block";
}

function closeModal() {
    document.getElementById('myModal').style.display = "none";
}

function selectProducto(id, nombre) {
    document.getElementById('cliente').value = id;
    closeModal();
}

function searchProduct() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("productTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1]; 
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
</script>

<style>
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    max-height: 500px;
    overflow-y: auto;
    width: 80%;
    max-width: 900px;
    border-radius: 8px;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

#searchInput {
    width: 100%;
    margin-bottom: 10px;
    padding: 10px;
    box-sizing: border-box;
}

.table-container {
    overflow: auto;
}

#productTable {
    width: 100%;
}

#productTable th,
#productTable td {
    border-bottom: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

#productTable th {
    background-color: #f2f2f2;
}
</style>

@endsection