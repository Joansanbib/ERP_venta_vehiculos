<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" 
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
    crossorigin="anonymous"></script>
    <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/luxon"></script>




</head>
<body>
    <style>
            
        body{
            background-color: #ECECEC;
        }
        #btn-section{
            width:100%;
            min-height: 100px;
            display:flex;
            flex-flow: row wrap;
            justify-content: center;
            align-items: center;
        }
        #header{
            width: 100%;
            min-height: 100px;
            display: flex;
            flex-flow: row wrap;
            justify-content: space-between;
            align-items: center;
            margin: 0;
            background-image: linear-gradient(to bottom, #546876, #ECECEC);
        }
        #btn-section #btn{
            background-color: #424242  !important;
            color: white;
        }
        #table_div{
            display:flex;
            justify-content:center; 
        }
        #table_div td{
            text-align: center;
        }
        #table_div tr{
            text-align : center;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px; /* Ajusta el margen según sea necesario */
        }
        #btn-newElement{
        width: 100px;
        height: 100px;
        }

    </style>
     <style>
        /* Estilo para el menú lateral */
        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #546876; /* Cambia el color según tus preferencias */
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 90px;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 20px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #ccc;
            color: black;
        }

        .sidebar .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 36px;
            margin-left: 50px;
        }

        /* Estilo para el botón de hamburguesa */
        .hamburger-btn {
            font-size: 30px;
            padding: 20px;
            background-color: transparent;
            border: none;
            cursor: pointer;
            position: absolute;
            top: 10px;
            left: 10px;
        }
        #openBtn{
            margin-left : 50px;
            background-color :  #424242 !important;
            border : none;
        }
        #mySidebar{
            text-align: center;
        }
        #mySidebar a{
            margin-top: 20px;
        }
    </style>
    <style>
         #user-profile-btn {
            font-size: 20px;
            padding: 10px 20px;
            background-color: #424242;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 20px;
        }

        #user-profile-btn i {
            margin-right: 5px;
        }

        #user-profile-btn:hover {
            background-color: #546876;
        }
    </style>



    <header id="header">
        @auth
         <!-- Botón para la hamburguesa -->
         <button class="btn btn-primary" id="openBtn">&#9776;</button>
        <!-- Menú lateral -->
        <div id="mySidebar" class="sidebar">
            <a href="javascript:void(0)" class="close-btn" id="closeBtn">&times;</a>
            <a href="/">Módulo Poductos y Servicios</a>
            <a href="/clientes">Módulo Clientes</a>
            <a href="/propuestas">Módulo Propuestas y Ventas</a>
        </div>
        <a href="/perfil">
        <button id="user-profile-btn">
            <i class="fas fa-user"></i> Perfil
        </button>
        </a>
        @endauth
    </header>

    @yield('body')

    <script>
        // Función para abrir el menú lateral
        function openNav() {
            document.getElementById("mySidebar").style.width = "250px";
        }

        // Función para cerrar el menú lateral
        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
        }

        // Evento de clic en el botón para abrir el menú lateral
        document.getElementById("openBtn").addEventListener("click", openNav);

        // Evento de clic en el botón para cerrar el menú lateral
        document.getElementById("closeBtn").addEventListener("click", closeNav);
    </script>

</body>
</html>