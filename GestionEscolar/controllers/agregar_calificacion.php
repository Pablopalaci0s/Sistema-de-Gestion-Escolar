<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <h1 class="hero__title">Sistema de gestión escolar</h1>
            <p class="hero__title">gestión de estudiantes</p>
            <a href="#" class="cta"> desliza</a>
        </section>
    </header>
    <?php
    require_once('../models/db_connection.php');

    // Procesar el formulario de registro de calificaciones
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $estudiante_id = $_POST['estudiante_id'];
        $asignatura_id = $_POST['asignatura_id'];
        $calificacion = $_POST['calificacion'];

        // Validar los datos ingresados antes de agregar la calificación a la base de datos
        // (Asegúrate de que los valores sean numéricos y estén dentro de rangos válidos)

        // Lógica para conectar a la base de datos y agregar la calificación
        $query = "INSERT INTO calificaciones (estudiante_id, asignatura_id, calificacion) VALUES ('$estudiante_id', '$asignatura_id', '$calificacion')";
        $result = mysqli_query($con, $query);

        if ($result) {
            echo "Calificación registrada exitosamente.";
        } else {
            echo "Error al registrar la calificación: " . mysqli_error($con);
        }
    }

    // Obtener la lista de estudiantes y asignaturas
    $query_estudiantes = "SELECT id, nombre FROM estudiantes";
    $query_asignaturas = "SELECT id, nombre FROM asignaturas";

    $result_estudiantes = mysqli_query($con, $query_estudiantes);
    $result_asignaturas = mysqli_query($con, $query_asignaturas);
    ?>
    
    <h1>Registro de Calificaciones</h1>
    <form action="agregar_calificacion.php" method="post">
        <label for="estudiante_id">Estudiante:</label>
        <select name="estudiante_id" required>
            <!-- Mostrar la lista de estudiantes -->
            <option value="">Seleccione un estudiante</option>
            <?php
            while ($row = mysqli_fetch_assoc($result_estudiantes)) {
                echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
            }
            ?>
        </select><br>

        <label for="asignatura_id">Asignatura:</label>
        <select name="asignatura_id" required>
            <!-- Mostrar la lista de asignaturas -->
            <option value="">Seleccione una asignatura</option>
            <?php
            while ($row = mysqli_fetch_assoc($result_asignaturas)) {
                echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
            }
            ?>
        </select><br>

        <label for="calificacion">Calificación:</label>
        <input type="number" name="calificacion" step="0.01" required><br>

        <input type="submit" value="Registrar Calificación">
    </form>
    <script src="../resources/js/em2.js"></script>
<script src="../resources/js/slider.js"></script>
    <script src="../resoures/js/questions.js"></script>
    <script src="../resources/js/menu.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../resources/js/des.js"></script>
</body>
</html>