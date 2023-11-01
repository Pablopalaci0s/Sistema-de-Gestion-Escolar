
<!DOCTYPE html>
<html>
<head>
    <title>Editar Profesor</title>
    <link rel="stylesheet" href="../resources/css/editar.css">
</head>
<body>
    <header class="hero">
        <!-- ... (tu código para el encabezado aquí) ... -->
    </header>

    <section class="container">
        <h1>Editar Profesor</h1>
        <?php
        // Comprobar si se ha proporcionado el parámetro 'id' a través de la URL
        if (isset($_GET['id'])) {
            // Obtener el ID del profesor desde la URL y almacenarlo en la variable $id
            $id = $_GET['id'];

            // Establecer una conexión a la base de datos MySQL
            $con = mysqli_connect("localhost", "root", "", "users");
            // Verificar si ha ocurrido un error en la conexión a la base de datos
            if (mysqli_connect_errno()) {
                // Mostrar un mensaje de error y detener el script si ha ocurrido un error
                die("Error al conectar con la base de datos: " . mysqli_connect_error());
            }

            // Realizar una consulta SQL para obtener los datos del profesor por su ID
            $query = "SELECT * FROM profesores WHERE id = $id";
            $result = mysqli_query($con, $query);
            $profesor = mysqli_fetch_assoc($result);

            // Verificar si se encontró un profesor con el ID dado
            if (!$profesor) {
                // Mostrar un mensaje de error y detener el script si no se encuentra el profesor
                die("No se encontró un profesor con el ID especificado.");
            }

            // Asignar los datos del profesor a las variables correspondientes
            $nombre = $profesor['nombre'];
            $apellido = $profesor['apellido'];
            $correo = $profesor['correo'];
            $telefono = $profesor['telefono'];
            $salario = $profesor['salario'];
            $fecha_contrato = $profesor['fecha_contrato'];
            $cursos_id = $profesor['cursos_id']; // Campo "cursos_id"

            // Obtener la lista de cursos disponibles para mostrar en la lista desplegable
            $query_cursos = "SELECT id, nombre FROM cursos";
            $result_cursos = mysqli_query($con, $query_cursos);

            // Cerrar la conexión a la base de datos
            mysqli_close($con);
        }
        ?>

        <!-- Formulario para editar los datos del profesor -->
        <form action="actualizar.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $nombre; ?>" required>

            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" value="<?php echo $apellido; ?>" required>

            <label for="correo">Correo:</label>
            <input type="email" name="correo" value="<?php echo $correo; ?>" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" value="<?php echo $telefono; ?>" required>

            <label for="salario">Salario:</label>
            <input type="number" name="salario" step="0.01" value="<?php echo $salario; ?>" required>

            <label for="fecha_contrato">Fecha Contrato:</label>
            <input type="date" name="fecha_contrato" value="<?php echo $fecha_contrato; ?>" required>

            <label for="cursos_id">Cursos que imparte:</label>
            <select name="cursos_id" required>
                <option value="">Seleccione un curso</option>
                <?php
                // Mostramos las opciones en la lista desplegable
                while ($curso = mysqli_fetch_assoc($result_cursos)) {
                    $selected = ($curso['id'] == $cursos_id) ? "selected" : "";
                    echo "<option value='" . $curso['id'] . "' $selected>" . $curso['nombre'] . "</option>";
                }
                ?>
            </select>

            <input type="submit" value="Actualizar">
        </form>
    </section>
</body>
</html>