<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../administradores/css/style.css">
    
    

</head>
<body>
<header class="hero">
        <nav class="nav container">
            <div class="nav__logo">
                <h2 class="nav__title">Bright Horizons Academy.</h2>
            </div>

            <ul class="nav__link nav__link--menu">
                <li class="nav__items">
                    <a href="../usuarios/admin.php" class="nav__links">Inicio</a>
                </li>
                <li class="nav__items">
                    <a href="../administradores/index.php" class="nav__links">Gestión de profesores</a>
                </li>
                <li class="nav__items">
                    <a href="#" class="nav__links">gestión de estudiantes</a>
                </li>

                <li class="nav__items">
                    <a href="../profesores/agregar_horario.php" class="nav__links">Asistencias P</a>
                </li>
                <li class="nav__items">
                    <a href="../profesores/agregar_horario.php" class="nav__links">Asistencias E</a>
                </li>
                <li class="nav__items">
                <a href="../registro/index.php" class="nav__links">Cerrar sesión</a>
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
    <title>Historial de Calificaciones</title>
    <!-- Agregar enlaces a los archivos CSS y JS -->
</head>
<body>
<?php
    require_once('db_connection.php');

    // Obtener el historial de calificaciones
    $query_calificaciones = "SELECT calificaciones.id, estudiantes.nombre AS estudiante, asignaturas.nombre AS asignatura, calificaciones.calificacion
                            FROM calificaciones
                            INNER JOIN estudiantes ON calificaciones.estudiante_id = estudiantes.id
                            INNER JOIN asignaturas ON calificaciones.asignatura_id = asignaturas.id";

    $result_calificaciones = mysqli_query($con, $query_calificaciones);
    ?>
    
    <h1>Historial de Calificaciones</h1>
    <!-- Mostrar la tabla con el historial de calificaciones -->
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Estudiante</th>
            <th>Asignatura</th>
            <th>Calificación</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result_calificaciones)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['estudiante'] . "</td>";
            echo "<td>" . $row['asignatura'] . "</td>";
            echo "<td>" . $row['calificacion'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>