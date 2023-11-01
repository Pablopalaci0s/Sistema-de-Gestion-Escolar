<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes</title>
    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../resources/css/normalize.css">
    <link rel="stylesheet" href="../resources/css/style.css">
    <link rel="stylesheet" href="../resources/css/em2.css">
    <link rel="stylesheet" href="../resources/css/style2.css">
  
   
    
    

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
      

        <section class="hero__container container" id ="cont">
            <h1 class="hero__title">Bright Horizons Academy</h1>
            <p class="hero__title">gestión de estudiantes</p>
            <a href="#" class="cta"> desliza</a>
        </section>
    </header>

    <section id="buscar-estudiantes" class="container">

    <div id="centrado">
    <button id ="botonagregar2">Buscar Estudiantes por Grado y Sección</button>
    </div>

    <div id="miModal2" class="modal2">
    <div class="modal-contenido2">
    <span class="cerrar2" id="botonCerrar2">&times;</span>
    <form class="modal-formulario2" action="../controllers/buscar.php" method="post">


       
        Grado:
        <select name="grado" required>
            <option value="">Seleccione el grado</option>
            <option value="Primer Grado">Primer Grado</option>
            <option value="Segundo Grado">Segundo Grado</option>
            <option value="Tercer Grado">Tercer Grado</option>
            <option value="Cuarto Grado">Cuarto Grado</option>
            <option value="Quinto Grado">Quinto Grado</option>
            <option value="Sexto Grado">Sexto Grado</option>
            <option value="Séptimo Grado">Séptimo Grado</option>
            <option value="Octavo Grado">Octavo Grado</option>
            <option value="Noveno Grado">Noveno Grado</option>
            <option value="Primer Año">Primer Año</option>
            <option value="Segundo Año">Segundo Año</option>
            <option value="Tercer Año">Tercer Año</option>
          
        </select>
       
        <div id="sselect">
        Sección:
        <select name="seccion" required>
            <option value="">Seleccione la sección</option>
            <option value="A">Sección A</option>
            <option value="B">Sección B</option>
            <option value="C">Sección C</option>
            <option value="D">Sección D</option>
            <option value="E">Sección E</option>
            <option value="F">Sección F</option>
            <option value="G">Sección G</option>
           
        </select>
        </div>
       
        <input type="submit" value="Buscar">
    </form>


</div>
</div>
</section>

<div id="centrado">
<button id ="botonagregar3" class="botongrados">Asistencias De Grados y Secciones</button>
</div>

<div class="modal3" id="miModal3">
    <div class="modal-contenido3">
    <span class="cerrar3" id="botonCerrar3">&times;</span>
    <form class="modal-formulario3" action="mostrar_estudiantes.php" method="post">
        Grado:
        <select name="grado" required>
            <option value="">Seleccione el grado</option>
            <?php
            $con = mysqli_connect("localhost", "root", "", "users");
            if (mysqli_connect_errno()) {
                die("Error al conectar con la base de datos: " . mysqli_connect_error());
            }

            $query = "SELECT DISTINCT grado FROM estudiantes";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_array($result)) {
                echo "<option value='" . $row['grado'] . "'>" . $row['grado'] . "</option>";
            }

            mysqli_close($con);
            ?>
        </select><br>
        Sección:
        <select name="seccion" required>
            <option value="">Seleccione la sección</option>
            <option value="A">Sección A</option>
            <option value="B">Sección B</option>
            <option value="C">Sección C</option>
            <option value="D">Sección D</option>
            <option value="E">Sección E</option>
            <option value="F">Sección F</option>
            <option value="G">Sección G</option>
            
            >
            <!-- Agrega más opciones para otras secciones -->
        </select><br>
        <input type="submit" value="Mostrar Estudiantes">
    </form>
        </div>
        </div>

    <div id="centrado">
    <button id="botonagregar">Agregar nuevo estudiante</button>
    </div>

    <div id="miModal" class="modal">
    <div class="modal-contenido">
    <span class="cerrar" id="botonCerrar">&times;</span>
<form class="modal-formulario" action="../controllers/agregar.php" method="post">
    Nombre: <input type="text" name="nombre" required><br>
    Dirección: <input type="text" name="direccion" required><br>
    Fecha de Nacimiento: <input type="date" name="fecha_nacimiento" required><br>
    Número de Identificación: <input type="text" name="numero_identificacion" required><br>

    <div id="selectt">
    Grado:
    <select name="grado" required>
    <option value="">Seleccione el grado</option>
            <option value="Primer Grado">Primer Grado</option>
            <option value="Segundo Grado">Segundo Grado</option>
            <option value="Tercer Grado">Tercer Grado</option>
            <option value="Cuarto Grado">Cuarto Grado</option>
            <option value="Quinto Grado">Quinto Grado</option>
            <option value="Sexto Grado">Sexto Grado</option>
            <option value="Séptimo Grado">Séptimo Grado</option>
            <option value="Octavo Grado">Octavo Grado</option>
            <option value="Noveno Grado">Noveno Grado</option>
            <option value="Primer Año">Primer Año</option>
            <option value="Segundo Año">Segundo Año</option>
            <option value="Tercer Año">Tercer Año</option>
    </select><br>
    Sección:
    <select name="seccion" required>
    <option value="">Seleccione la sección</option>
            <option value="A">Sección A</option>
            <option value="B">Sección B</option>
            <option value="C">Sección C</option>
            <option value="D">Sección D</option>
            <option value="E">Sección E</option>
            <option value="F">Sección F</option>
            <option value="G">Sección G</option>
    </select><br>
    </div>
    <input type="submit" value="Agregar">
</form>
        </div>
        </div>




    <script>
         // Función para el scroll suave
         function scrollToSection(elementId) {
            const element = document.getElementById(elementId);
            if (element) {
                element.scrollIntoView({ behavior: "smooth" });
            }
        }

        // Obtenemos el enlace "Comienza ahora" y le añadimos el evento click
        const comienzaAhoraLink = document.querySelector(".cta");
        comienzaAhoraLink.addEventListener("click", function (event) {
            event.preventDefault();
            scrollToSection("lista-estudiantes");
        });
    </script>

     
    </main>
    <section id="lista-estudiantes" class="container">
    <?php
    $con = mysqli_connect("localhost", "root", "", "users");
    if (mysqli_connect_errno()) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    // Obtener la lista de estudiantes con su grado y sección
    $query = "SELECT * FROM estudiantes";
    $result = mysqli_query($con, $query);

    // Mostrar la tabla de estudiantes
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Fecha de Nacimiento</th>
                <th>Número de Identificación</th>
                <th>Grado</th>
                <th>Sección</th>
                <th>Acciones</th>
            </tr>";

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['direccion'] . "</td>";
        echo "<td>" . $row['fecha_nacimiento'] . "</td>";
        echo "<td>" . $row['numero_identificacion'] . "</td>";
        echo "<td>" . $row['grado'] . "</td>"; // Imprimir el grado
        echo "<td>" . $row['seccion'] . "</td>"; // Imprimir la sección
        echo "<td><a href='editar.php?id=" . $row['id'] . "'>Editar</a> | <a href='eliminar.php?id=" . $row['id'] . "'>Eliminar</a></td>";
        echo "</tr>";
    }

    echo "</table>";

    mysqli_close($con);
    ?>





</body>

<script src="../resources/js/em.js"></script>
<script src="../resources/js/em2.js"></script>
<script src="../resources/js/slider.js"></script>
    <script src="../resoures/js/questions.js"></script>
    <script src="../resources/js/menu.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../resources/js/des.js"></script>



</html>