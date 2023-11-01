<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="shortcut icon" href="../../resources/img/hat.png" type="image/x-icon">
    <link rel="stylesheet" href="../../resources/css/normalize.css">
    <link rel="stylesheet" href="../../resources/css/style.css">
    <link rel="stylesheet" href="../../resources/css/em2.css">


</head>

<body>
    <header class="hero">
        <nav class="nav container">
            <div class="nav__logo">
                <h2 class="nav__title">Bright Horizons Academy.</h2>
            </div>

            <ul class="nav__link nav__link--menu">

                <li class="nav__items">
                    <a href="../controllers/admin.php" class="nav__links">Inicio</a>
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
    <section id="buscar-estudiantes" class="container">
        <div id="centrado">
            <button id="botonagregar2">Buscar Estudiantes por Grado y Sección</button>
        </div>

        <div id="miModal2" class="modal2">
            <div class="modal-contenido2">
                <span class="cerrar2" id="botonCerrar2">&times;</span>
                <form class="modal-formulario2" action="buscar/buscar.php" method="post">
                    Grado:
                    <select name="grado" required>
                        <option value="">Seleccione el grado</option>
                        <?php
                        require '../../models/db_connection.php';

                        $query = "SELECT id, nombre FROM grado ORDER BY nombre ASC";
                        $result = mysqli_query($con, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                            }
                        } else {
                            echo "<option disabled>No se encontraron grados.</option>";
                        }

                        mysqli_close($con);
                        ?>
                    </select>

                    <div id="sselect">
                        Sección:
                        <select name="seccion" required>
                            <option value="">Seleccione la sección</option>
                            <?php
                            require '../../models/db_connection.php';

                            $query = "SELECT id, name FROM section ORDER BY name ASC";
                            $result = mysqli_query($con, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                }
                            } else {
                                echo "<option disabled>No se encontraron secciones.</option>";
                            }

                            mysqli_close($con);
                            ?>
                        </select>
                    </div>

                    <input type="submit" value="Buscar">
                </form>
            </div>
        </div>
    </section>


    <div id="centrado">
        <button id="botonagregar3" class="botongrados">Asistencias De Grados y Secciones</button>
    </div>

    <div class="modal3" id="miModal3">
        <div class="modal-contenido3">
            <span class="cerrar3" id="botonCerrar3">&times;</span>
            <form class="modal-formulario3" action="../../view/estudiante/mostrar/mostrar_estudiantes.php" method="post">
                <label for="grado">Grado:</label>
                <select name="grado" id="grado" required>
                    <option value="">Seleccione el grado</option>
                    <?php
                    require '../../models/db_connection.php';

                    $query = "SELECT id, nombre FROM grado ORDER BY nombre ASC";
                    $result = mysqli_query($con, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                        }
                    } else {
                        echo "<option disabled>No se encontraron grados.</option>";
                    }

                    mysqli_close($con);
                    ?>
                </select><br>

                <label for="seccion">Sección:</label>
                <select name="seccion" id="seccion" required>
                    <option value="">Seleccione la sección</option>
                    <?php
                    require '../../models/db_connection.php';

                    $query = "SELECT id, name FROM section ORDER BY name ASC";
                    $result = mysqli_query($con, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                        }
                    } else {
                        echo "<option disabled>No se encontraron secciones.</option>";
                    }

                    mysqli_close($con);
                    ?>
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
            <form class="modal-formulario" action="agregar/agregar.php" method="post">
                Nombre: <input type="text" name="nombre" required><br>
                Dirección: <input type="text" name="direccion" required><br>
                Fecha de Nacimiento: <input type="date" name="fecha_nacimiento" required><br>
                Número de Identificación: <input type="text" name="numero_identificacion" required><br>

                <div id="selectt">
                    Grado:
                    <select name="grado" required>
                        <option value="">Seleccione el grado</option>
                        <?php
                        require '../../models/db_connection.php';

                        $query = "SELECT id, nombre FROM grado";
                        $result = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                        }

                        mysqli_close($con);
                        ?>
                    </select><br>
                    Sección:
                    <select name="seccion" required>
                        <option value="">Seleccione la sección</option>
                        <?php
                        require '../../models/db_connection.php';

                        $query = "SELECT id, name FROM section";
                        $result = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                        }

                        mysqli_close($con);
                        ?>
                    </select><br>
                </div>
                <input type="submit" value="Agregar">
            </form>
        </div>
    </div>
    </main>
    <section id="lista-estudiantes" class="container">
        <?php
        require '../../models/db_connection.php';

        // Obtener la lista de estudiantes con nombres de grado y sección
        $query = "SELECT estudiantes.*, grado.nombre AS nombre_grado, section.name AS nombre_seccion 
              FROM estudiantes 
              JOIN grado ON estudiantes.id_grade = grado.id 
              JOIN section ON estudiantes.id_section = section.id";

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
            echo "<td>" . $row['nombre_grado'] . "</td>";
            echo "<td>" . $row['nombre_seccion'] . "</td>";
            echo "<td><a href='editar/editar.php?id=" . $row['id'] . "'>Editar</a> | <a href='editar/eliminar.php?id=" . $row['id'] . "'>Eliminar</a></td>";
            echo "</tr>";
        }

        echo "</table>";

        mysqli_close($con);
        ?>
    </section>

</body>

<script>
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
<script src="../../resources/js/em2.js"></script>
<script src="../../resources/js/slider.js"></script>
<script src="../../resoures/js/questions.js"></script>
<script src="../../resources/js/menu.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../resources/js/des.js"></script>




</html>