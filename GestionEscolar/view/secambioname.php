<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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

        
        <section class="hero__container container">
            <h1 class="hero__title">Bright Horizons Academy</h1>
            <p class="hero__title">Gestión de profesores</p>
            <a href="#" class="cta">Desliza</a>
        </section>
    </header>
    <section class="container">

    <div id="centrado2">
    <button id="botonagregar2">Buscar Profesores por Curso</button>
    </div>

    <div id="miModal2" class="modal2">
    <div class="modal-contenido2">
    <span class="cerrar2" id="botonCerrar2">&times;</span>
        <form class="modal-formulario2" action="../controllers/buscar.php" method="post">
            <label for="curso">Nombre del Curso:</label>
            <select name="curso" required>
                <option value="">Seleccione un curso</option>
                <?php
                // Conectarse a la base de datos nuevamente para obtener la lista de cursos
                $con = mysqli_connect("localhost", "root", "", "users");
                if (mysqli_connect_errno()) {
                    die("Error al conectar con la base de datos: " . mysqli_connect_error());
                }

                $query = "SELECT nombre FROM cursos";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='" . $row['nombre'] . "'>" . $row['nombre'] . "</option>";
                }

                mysqli_close($con);
                ?>
            </select>
            <input type="submit" value="Buscar">
        </form>
            </div>
            </div>
    </section>

    <section class="container">

    <div id ="centrado">
    <button id="botonagregar">Agregar nuevo profesor</button>
    </div>

    <div id="miModal" class="modal">
    <div class="modal-contenido">
    <span class="cerrar" id="botonCerrar">&times;</span>
        <form class="modal-formulario" action="../controllers/agregar.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required><br>

            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" required><br>

            <label for="correo">Correo:</label>
            <input type="email" name="correo" required><br>

            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" required><br>

            <label for="salario">Salario:</label>
            <input type="number" name="salario" step="0.01" required><br>

            <label for="fecha_contrato">Fecha Contrato:</label>
            <input type="date" name="fecha_contrato" required><br>

            <label for="cursos">Cursos que imparte:</label>
            <select name="cursos" required>
                <option value="">Seleccione un curso</option>
                <?php
                // Conectarse a la base de datos nuevamente para obtener la lista de cursos
                $con = mysqli_connect("localhost", "root", "", "users");
                if (mysqli_connect_errno()) {
                    die("Error al conectar con la base de datos: " . mysqli_connect_error());
                }

                $query = "SELECT nombre FROM cursos";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='" . $row['nombre'] . "'>" . $row['nombre'] . "</option>";
                }

                mysqli_close($con);
                ?>
            </select>
            <input type="submit" value="Agregar">
        </form>
            </div>
            </div>
    </section>

   
    <script>
        // Función para el scroll suave
        function scrollToSection(elementId) {
            const element = document.getElementById(elementId);
            if (element) {
                element.scrollIntoView({ behavior: "smooth" });
            }
        }

        // Obtenemos el enlace "Desliza" y le añadimos el evento click
        const deslizaLink = document.querySelector(".cta");
        deslizaLink.addEventListener("click", function (event) {
            event.preventDefault();
            scrollToSection("lista-profesores");
        });
    </script>
    <section id="lista-profesores" class="container">
        <?php
        $con = mysqli_connect("localhost", "root", "", "users");
        if (mysqli_connect_errno()) {
            die("Error al conectar con la base de datos: " . mysqli_connect_error());
        }

        // Obtener la lista de profesores
        $query = "SELECT * FROM profesores";
        $result = mysqli_query($con, $query);

        // Mostrar la tabla de profesores
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Salario</th>
                    <th>Fecha Contrato</th>
                    <th>Cursos que imparte</th>
                    <th>Acciones</th>
                </tr>";

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>" . $row['apellido'] . "</td>";
            echo "<td>" . $row['correo'] . "</td>";
            echo "<td>" . $row['telefono'] . "</td>";
            echo "<td>" . $row['salario'] . "</td>";
            echo "<td>" . $row['fecha_contrato'] . "</td>";
            echo "<td>" . $row['cursos'] . "</td>"; // Agregar columna de cursos que imparte
            echo "<td><a href='../controllers/editar.php?id=" . $row['id'] . "'>Editar</a> | <a href='../controllers/eliminar.php?id=" . $row['id'] . "'>Eliminar</a></td>";
            echo "</tr>";
        }

        echo "</table>";

        // Cerrar la conexión
        mysqli_close($con);
        ?>
    </section>



  

    
</body>

<script src="../resources/js/em2.js"></script>
<script src="../resources/js/slider.js"></script>
    <script src="../resoures/js/questions.js"></script>
    <script src="../resources/js/menu.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../resources/js/des.js"></script>
</body>
</html>