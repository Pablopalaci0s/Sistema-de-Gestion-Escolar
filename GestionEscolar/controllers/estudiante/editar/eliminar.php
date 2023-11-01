<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    require_once '../../../models/db_connection.php';
    $query = "DELETE FROM estudiantes WHERE id = $id";
    if (mysqli_query($con, $query)) {
        // Cierre la conexión antes de redireccionar
        mysqli_close($con);

        // Muestra un mensaje de eliminación exitosa y redirige después de 2 segundos
        echo "<script>
            setTimeout(function() {
                alert('Estudiante eliminado exitosamente.');
                window.location.href = '../adestudiantes.php'; // Redirige a la página anterior
            }, 2000); // 2000 milisegundos (2 segundos)
        </script>";

        // Detiene la ejecución del código PHP aquí para evitar que la página se siga procesando
        exit;
    } else {
        echo "Error al eliminar el estudiante: " . mysqli_error($con);
    }

    mysqli_close($con);
}
