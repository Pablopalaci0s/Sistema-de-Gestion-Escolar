<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de la Búsqueda</title>
    <link rel="stylesheet" href="../../../resources/css/style.css">
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
                    <a href="../../../view/admin.php" class="nav__links">Inicio</a>
                </li>
                <li class="nav__items">
                    <a href="../../cerrar_sesion.php" class="nav__links">Cerrar sesión</a>
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

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $grado_id = $_POST['grado'];
        $seccion_id = $_POST['seccion'];

        require '../../../models/db_connection.php';

        // Escapar las comillas simples para evitar problemas con la consulta SQL
        $grado_id = mysqli_real_escape_string($con, $grado_id);
        $seccion_id = mysqli_real_escape_string($con, $seccion_id);

        // Obtener los nombres de grado y sección a partir de las tablas "grado" y "section"
        $grado_query = "SELECT nombre FROM grado WHERE id = '$grado_id'";
        $seccion_query = "SELECT name FROM section WHERE id = '$seccion_id'";

        $grado_result = mysqli_query($con, $grado_query);
        $seccion_result = mysqli_query($con, $seccion_query);

        $grado_nombre = "";
        $seccion_nombre = "";

        if ($grado_row = mysqli_fetch_assoc($grado_result)) {
            $grado_nombre = $grado_row['nombre'];
        }

        if ($seccion_row = mysqli_fetch_assoc($seccion_result)) {
            $seccion_nombre = $seccion_row['name'];
        }

        $query = "SELECT * FROM estudiantes WHERE id_grade = '$grado_id' AND id_section = '$seccion_id'";
        $result = mysqli_query($con, $query);

        // Mostrar los resultados de la búsqueda
        echo "<h2>Resultados de la búsqueda</h2>";
        echo "<p>Grado: " . $grado_nombre . "</p>";
        echo "<p>Sección: " . $seccion_nombre . "</p>";
        echo " <section id='lista-estudiantes' class='container'>";
        echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Fecha de Nacimiento</th>
                <th>Número de Identificación</th>
                <th>Grado</th>
                <th>Sección</th>
            </tr>";

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>" . $row['direccion'] . "</td>";
            echo "<td>" . $row['fecha_nacimiento'] . "</td>";
            echo "<td>" . $row['numero_identificacion'] . "</td>";
            echo "<td>" . $grado_nombre . "</td>";
            echo "<td>" . $seccion_nombre . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "<br><button onclick='goBack()'>Regresar</button>";
        echo "</section>";
        mysqli_close($con);
    }
    ?>

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
</body>

</html>