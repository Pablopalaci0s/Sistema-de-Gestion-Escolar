<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="shortcut icon" href="../../../resources/img/hat.png" type="image/x-icon">
    <link rel="stylesheet" href="../../../resources/css/normalize.css">
    <link rel="stylesheet" href="../../../resources/css/style.css">
    <link rel="stylesheet" href="../../../resources/css/em2.css">


</head>

<body>
    <header class="hero">
        <nav class="nav container">
            <div class="nav__logo">
                <h2 class="nav__title">Bright Horizons Academy.</h2>
            </div>

            <ul class="nav__link nav__link--menu">

                <li class="nav__items">
                    <a href="../../admin.php" class="nav__links">Inicio</a>
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
                    </div>
                </li>

                <li class="option">
                    <a><button class="nav__dropdown-toggle3">Otros</button></a>
                    <div class="lista3">
                        <p class="element"> <a href="../view/admin_libros.php" class="choice">Biblioteca </a> </p>
                        <p class="element"> <a href="../view/registro.html" class="choice">Usuarios</a></p>
                    </div>
                </li>



                <li class="nav__items">
                    <a href="../controllers/cerrar_sesion.php" class="nav__links">Cerrar sesión</a>
                </li>



                <img src="../images/close.svg" class="nav__close">
            </ul>

            <div class="nav__menu">
                <img src="../images/menu.svg" class="nav__img">
            </div>
        </nav>


        <section class="hero__container container" id="cont">
            <h1 class="hero__title">Bright Horizons Academy</h1>
            <p class="hero__title">gestión de estudiantes</p>
            <a href="#" class="cta"> desliza</a>
        </section>
    </header>
    <div>
        <br><button onclick='goBack()'>Regresar</button>
    </div>

    <?php
    require '../../../models/db_connection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_grade = $_POST['grado'];
        $id_section = $_POST['seccion'];

        $id_grade = mysqli_real_escape_string($con, $id_grade);
        $id_section = mysqli_real_escape_string($con, $id_section);

        $query = "SELECT estudiantes.*, grado.nombre AS nombre_grado, section.name AS nombre_seccion 
              FROM estudiantes 
              JOIN grado ON estudiantes.id_grade = grado.id 
              JOIN section ON estudiantes.id_section = section.id 
              WHERE estudiantes.id_grade = '$id_grade' AND estudiantes.id_section = '$id_section'";

        $result = mysqli_query($con, $query);
        echo " <section id='lista-estudiantes' class='container'>";
        echo "<h2>Estudiantes encontrados:</h2>";
        echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Fecha de Nacimiento</th>
                <th>Número de Identificación</th>
                <th>Grado</th>
                <th>Sección</th>
                <th>Asistencia</th>
            </tr>";

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>" . $row['direccion'] . "</td>";
            echo "<td>" . $row['fecha_nacimiento'] . "</td>";
            echo "<td>" . $row['numero_identificacion'] . "</td>";
            echo "<td>" . $row['nombre_grado'] . "</td>"; // Mostrar el nombre del grado
            echo "<td>" . $row['nombre_seccion'] . "</td>"; // Mostrar el nombre de la sección
            echo "<td>
            <form action='../../../controllers/estudiante/asistencia/registrar_asistencia.php' method='post'>
                <input type='hidden' name='id_estudiante' value='" . $row['id'] . "'>
                <input type='hidden' name='grado' value='" . $row['nombre_grado'] . "'> 
                <input type='hidden' name='seccion' value='" . $row['nombre_seccion'] . "'> 
                <select name='asistencia' required>
                    <option value='Presente'>Presente</option>
                    <option value='Ausente'>Ausente</option>
                </select>
                <input type='submit' value='Registrar'>
            </form>
        </td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</section>";

        mysqli_close($con);
    }
    ?>
</body>
<script>
    function goBack() {
        window.history.back();
    }
    // Función para el scroll suave
    function scrollToSection(elementId) {
        const element = document.getElementById(elementId);
        if (element) {
            element.scrollIntoView({
                behavior: "smooth"
            });
        }
    }

    // Obtenemos el enlace "Comienza ahora" y le añadimos el evento click
    const comienzaAhoraLink = document.querySelector(".cta");
    comienzaAhoraLink.addEventListener("click", function(event) {
        event.preventDefault();
        scrollToSection("lista-estudiantes");
    });
</script>
<script src="../../../resources/js/em2.js"></script>
<script src="...../../resources/js/slider.js"></script>
<script src="../../../resoures/js/questions.js"></script>
<script src="../../../resources/js/menu.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../../resources/js/des.js"></script>

</html>