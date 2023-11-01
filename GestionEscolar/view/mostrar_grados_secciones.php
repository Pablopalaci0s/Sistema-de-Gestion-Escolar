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
                <h2 class="nav__title">Gestión escolar.</h2>
            </div>

            <ul class="nav__link nav__link--menu">
                <li class="nav__items">
                    <a href="../usuarios/admin.php" class="nav__links">Inicio</a>
                </li>
                <li class="nav__items">
                    <a href="../administradores/index.php" class="nav__links">Gestión de profesores</a>
                </li>
                <li class="nav__items">
                    <a href="../estudiantes/adestudiantes.php" class="nav__links">Gestión de estudiantes</a>
                </li>

                <li class="nav__items">
                    <a href="../profesores/agregar_horario.php" class="nav__links">Asistencias P</a>
                </li>
                <li class="nav__items">
                    <a href="../asistencia/mostrar_grado_secciones.php" class="nav__links">Asistencias E</a>
                </li>
                <li class="nav__items">
                    <a href="index.html" class="nav__links">Cerrar sesión</a>
                </li>
                

                <img src="../images/close.svg" class="nav__close">
            </ul>

            <div class="nav__menu">
                <img src="../images/menu.svg" class="nav__img">
            </div>
        </nav>

        <section class="hero__container container">
            <h1 class="hero__title">Sistema de gestión escolar</h1>
            <p class="hero__title">Asistencia de estudiantes</p>
            <a href="#" class="cta"> desliza</a>
        </section>
    </header>
<body>
    <h2>Grados y Secciones</h2>
    <form action="mostrar_estudiantes.php" method="post">
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
</body>
</html>
