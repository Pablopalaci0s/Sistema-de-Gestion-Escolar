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

    // Construir la consulta SQL para eliminar el profesor de la tabla 'profesores' por su ID
    $query = "DELETE FROM profesores WHERE id = $id";

    // Ejecutar la consulta SQL utilizando mysqli_query()
    if (mysqli_query($con, $query)) {
        // Redireccionar a la página "index.php" si la eliminación fue exitosa
        header("Location: ../view/secambioname.php");
    } else {
        // Mostrar un mensaje de error si ha ocurrido algún problema durante la eliminación
        echo "Error al eliminar el profesor: " . mysqli_error($con);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($con);
}
?>
