<?php
require '../../../models/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $numero_identificacion = $_POST['numero_identificacion'];
    $id_grade = $_POST['grado'];
    $id_section = $_POST['seccion'];

    // Escapar las comillas simples para evitar problemas con la consulta SQL
    $nombre = mysqli_real_escape_string($con, $nombre);
    $direccion = mysqli_real_escape_string($con, $direccion);
    // ...

    $query = "INSERT INTO estudiantes (nombre, direccion, fecha_nacimiento, numero_identificacion, id_grade, id_section)
              VALUES ('$nombre', '$direccion', '$fecha_nacimiento', '$numero_identificacion', '$id_grade', '$id_section')";

    if (mysqli_query($con, $query)) {
        // Cierre la conexión antes de redireccionar
        mysqli_close($con);

        // Espera 3 segundos y luego redirige a la página anterior
        echo "<script>
            setTimeout(function() {
                window.history.go(-1); // Regresar a la página anterior
            }, 2000); // 3000 milisegundos (3 segundos)
        </script>";

        echo "Estudiante agregado exitosamente. Serás redirigido en 2 segundos.";

        // Detiene la ejecución del código PHP aquí para evitar que la página se siga procesando
        exit;
    } else {
        echo "Error al agregar el estudiante: " . mysqli_error($con);
    }

    mysqli_close($con);
}
