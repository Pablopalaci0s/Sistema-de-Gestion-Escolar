<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resources/css/horario.css">
    <link rel="shortcut icon" href="../resources/img/hat.png" type="image/x-icon">
    <link rel="stylesheet" href="../resources/css/normalize.css">
    <link rel="stylesheet" href="../resources/css/estilos.css">
    <title>Horarios</title>
</head>
<body>
<header class="hero">
        <nav class="nav container">
            <div class="nav__logo">
            <img class="nav__logo" src="../resources/img/logoo2.png" alt="">
                <h2 class="nav__title">Bright Horizons Academy</h2>
            </div>

            <ul class="nav__link nav__link--menu">
                <li><span>
                    <a href="../view/cliente.php" class="nav__links">Inicio</a></span>
                </li>
                <li><span>
                    <a href="../view/calendariouser.html" class="nav__links">Calendario</a></span>
                </li>
                <li><span>
                    <a href="contacto.html" class="nav__links">Contáctanos</a></span>
                </li>
                
                <li><span>
                    <a href="../controllers/login.php" class="nav__links">Biblioteca</a></span>
                </li>
                <li><span>
                    <a href="../view/ver_horarios.php" class="nav__links">Horarios</a></span>
                </li>
                <li><span>
                    <a href="../view/classroom.php" class="nav__links">Class</a></span>
                </li>
                <li><span>
                    <a href="../view/login.html" class="nav__links">Cerrar sesión</a></span>
                </li>

                <img src="../resources/img/close.svg" class="nav__close">
            </ul>

            <div class="nav__menu">
                <img src="../resources/img/menu.svg" class="nav__img">
            </div>
        </nav>


        <section class="hero__container container">
            <h1 class="hero__title">Bright Horizons Academy</h1>
            <p class="hero__title">Horarios</p>
            <a href="#" class="cta">Desliza</a>
        </section>
    </header>

    <div class="recuadros-grados-secciones">
        <?php
        // Consulta la base de datos para obtener los grados y secciones disponibles
        // Genera los enlaces o recuadros para cada grado y sección
        // Debes ejecutar una consulta similar a esta para obtener los grados y secciones disponibles
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "users";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Error de conexión a la base de datos: " . $conn->connect_error);
        }

        $sql = "SELECT DISTINCT grado, seccion FROM horario";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $grado = $row["grado"];
                $seccion = $row["seccion"];
                echo "<a class='recuadro' href='../controllers/horario/horario_individual.php?grado=$grado&seccion=$seccion'>";
                echo "<div class='contenido-recuadro'>$grado - $seccion</div>";
                echo "</a>";
            }
        } else {
            echo "No se encontraron grados y secciones.";
        }

        // Cierra la conexión a la base de datos
        $conn->close();
        ?>
    </div>
</body>
</html>
