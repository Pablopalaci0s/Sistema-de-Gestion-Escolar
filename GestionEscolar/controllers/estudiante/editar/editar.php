<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estudiante</title>
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


    <section class="container">
        <?php
        require '../../../models/db_connection.php';

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Consultar el estudiante por su ID
            $query = "SELECT estudiantes.*, grado.nombre AS nombre_grado, section.name AS nombre_seccion 
              FROM estudiantes 
              JOIN grado ON estudiantes.id_grade = grado.id 
              JOIN section ON estudiantes.id_section = section.id
              WHERE estudiantes.id = $id";

            $result = mysqli_query($con, $query);
            $estudiante = mysqli_fetch_assoc($result);

            if (!$estudiante) {
                echo "No se encontró un estudiante con ese ID.";
                exit;
            }
        } else {
            // Si no se proporcionó un ID válido, redireccionar a la página principal
            header("Location: index.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos enviados por el formulario de edición
            $nombre = $_POST['nombre'];
            $direccion = $_POST['direccion'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $numero_identificacion = $_POST['numero_identificacion'];
            $grado = $_POST['grado'];
            $seccion = $_POST['seccion'];

            // Actualizar los datos del estudiante en la base de datos con una consulta preparada
            $query = "UPDATE estudiantes SET nombre=?, direccion=?, fecha_nacimiento=?, numero_identificacion=?, id_grade=?, id_section=? WHERE id = ?";
            $stmt = mysqli_prepare($con, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssssiii", $nombre, $direccion, $fecha_nacimiento, $numero_identificacion, $grado, $seccion, $id);
                if (mysqli_stmt_execute($stmt)) {
                    echo "Estudiante actualizado exitosamente.";
                    // Recargar la página para mostrar los cambios
                    header("Refresh: 2"); // Recargar la página después de 2 segundos
                } else {
                    echo "Error al actualizar el estudiante: " . mysqli_error($con);
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "Error en la consulta preparada: " . mysqli_error($con);
            }
        }
        ?>

        <h2>Editar estudiante</h2>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            Nombre: <input type="text" name="nombre" value="<?php echo $estudiante['nombre']; ?>" required><br>
            Dirección: <input type="text" name="direccion" value="<?php echo $estudiante['direccion']; ?>" required><br>
            Fecha de Nacimiento: <input type="date" name="fecha_nacimiento" value="<?php echo $estudiante['fecha_nacimiento']; ?>" required><br>
            Número de Identificación: <input type="text" name="numero_identificacion" value="<?php echo $estudiante['numero_identificacion']; ?>" required><br>

            <div class="form-group">
                <label for="grado">Grado:</label>
                <select id="grado" name="grado" required>
                    <option value="">Seleccione el grado</option>
                    <?php
                    $query = "SELECT id, nombre FROM grado ORDER BY nombre ASC";
                    $result = mysqli_query($con, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $selected = ($row['id'] === $estudiante['id_grade']) ? 'selected' : '';
                        echo "<option value='" . $row['id'] . "' $selected>" . $row['nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="seccion">Sección:</label>
                <select id="seccion" name="seccion" required>
                    <option value="">Seleccione la sección</option>
                    <?php
                    $query = "SELECT id, name FROM section ORDER BY name ASC";
                    $result = mysqli_query($con, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $selected = ($row['id'] === $estudiante['id_section']) ? 'selected' : '';
                        echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <input type="submit" value="Actualizar">
        </form>
        <br><button onclick='goBack()'>Regresar</button>

    </section>

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
            scrollToSection("container");
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