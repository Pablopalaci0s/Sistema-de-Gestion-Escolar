<?php
if (isset($_GET['id'])) {
    // isset sirve para saber si algo esta declarado

    // recuperamos el dato por medio de la url
    $id = $_GET['id'];

    require_once '../db/db.php';
    $query = "DELETE FROM score WHERE id = $id";
    if (mysqli_query($con, $query)) {
        // Cierre la conexión antes de redireccionar
        mysqli_close($con);

        // Muestra un mensaje de eliminación exitosa y redirige después de 2 segundos
        echo "Estudiante agregado ";
        echo "<script>
            setTimeout(function() {
                alert('Estudiante eliminado exitosamente.');
                window.history.back(); // Redirige a la página anterior
            }, 1000); // 1000 milisegundos (2 segundos)
        </script>";

        // Detiene la ejecución del código PHP aquí para evitar que la página se siga procesando
        exit;
    } else {
        echo "Error al eliminar el estudiante: " . mysqli_error($con);
    }

    mysqli_close($con);
}