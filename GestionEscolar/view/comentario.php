<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "users";

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para seleccionar todos los datos de la tabla
$sql = "SELECT * FROM tabla_contacto";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tabla de Contacto</title>
    
    <link rel="stylesheet" href="../resources/css/style.css">
    <link rel="stylesheet" href="../resources/css/normalize.css">
    <link rel="stylesheet" href="../resources/css/style2.css">
    <link rel="stylesheet" type="text/css" href="../resources/css/comentariosadmin.css">
</head>
<body>
<header class="hero">
        <nav class="nav container">
            <div class="nav__logo">
                <h2 class="nav__title">Bright Horizons Academy.</h2>
            </div>

            <ul class="nav__link nav__link--menu">

<li class="nav__items">
<a href="../view/admin.php" class="nav__links">Inicio</a>
</li>

<li class="option">
 <a><button class="nav__dropdown-toggle">Profesores</button></a>
 <div class="lista">
 <p class="element"> <a href="../view/secambioname.php" class="choice">G profesores</a></p>
 <p class="element"> <a href="../controllers/agregar_horario.php" class="choice">Asistencias P</a></p>
</div>
</li>




<li class="option">
    <a><button class="nav__dropdown-toggle2">Estudiantes</button></a>
    <div class="lista2">
    <p class="element"> <a href="../controllers/adestudiantes.php" class="choice">G estudiantes</a> </p>
    <p class="element"> <a href="../view/calendario.html" class="choice">G calendario</a></p>
    <p class="element"> <a href="../controllers/agregar_calificacion.php" class="choice">Calificaciones</a></p>
    <p class="element"> <a href="../pagos/index_pagos.php" class="choice">Pagos</a></p>

   </div>
</li>

<li class="option">
    <a><button class="nav__dropdown-toggle3">Otros</button></a>
    <div class="lista3">
        
    <p class="element"> <a href="../view/comentario.php" class="choice" >Comentarios </a> </p>
    <p class="element"> <a href="../view/admin_libros.php" class="choice" >Biblioteca </a> </p>
    <p class="element"> <a href="../view/registro.html"  class="choice" >Usuarios</a></p>
   </div>
</li>


 
<li class="nav__items">
<a href="../view/login.html" class="nav__links">Cerrar sesión</a>
</li>



<img src="../images/close.svg" class="nav__close">
</ul>

            <div class="nav__menu">
                <img src="../images/menu.svg" class="nav__img">
            </div>
        </nav>


        <section class="hero__container container">
            <h1 class="hero__title">Bright Horizons Academy</h1>
            <p class="hero__title">gestión de biblioteca</p>
            <a href="#" class="cta"> desliza</a>
        </section>
    </header>

    <h1>Tabla de Contacto</h1>
    <table class="tabla-contacto">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Mensaje</th>
            <th>Fecha de Creación</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["correo"] . "</td>";
                echo "<td class='mensaje'>" . $row["mensaje"] . "</td>";
                echo "<td>" . $row["fecha_creacion"] . "</td>";
                echo "</tr>";
                
                
                
                
            }
        } else {
            echo "No se encontraron datos en la tabla.";
        }
        ?>
    </table>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const responderButtons = document.querySelectorAll(".responder-btn");
    const respuestaForm = document.getElementById("respuesta-form");

    responderButtons.forEach(button => {
        button.addEventListener("click", function() {
            const comentarioID = button.getAttribute("data-comentario");
            respuestaForm.style.display = "block";
            // También puedes prellenar un campo oculto en el formulario con el ID del comentario
            document.getElementById("comentario_id").value = comentarioID;
        });
    });
});
</script>
<script src="../resources/js/slider.js"></script>
    <script src="../resoures/js/questions.js"></script>
    <script src="../resources/js/menu.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../resources/js/des.js"></script>

</body>
</html>
