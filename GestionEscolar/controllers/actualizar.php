<?php
// Comprobar si la solicitud es del tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha proporcionado el campo 'id'
    if (isset($_POST['id'])) {
        // Obtener el valor del campo 'id' de la solicitud POST y almacenarlo en la variable $id
        $id = $_POST['id'];

        // Establecer una conexión a la base de datos MySQL
        $con = mysqli_connect("localhost", "root", "", "users");
        // Verificar si ha ocurrido un error en la conexión a la base de datos
        if (mysqli_connect_errno()) {
            // Mostrar un mensaje de error y detener el script si ha ocurrido un error
            die("Error al conectar con la base de datos: " . mysqli_connect_error());
        }

        // Escapar y prevenir posibles ataques de inyección SQL en las variables recibidas a través de la solicitud POST
        $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
        $apellido = mysqli_real_escape_string($con, $_POST['apellido']);
        $correo = mysqli_real_escape_string($con, $_POST['correo']);
        $telefono = mysqli_real_escape_string($con, $_POST['telefono']);
        $salario = mysqli_real_escape_string($con, $_POST['salario']);
        $fecha_contrato = mysqli_real_escape_string($con, $_POST['fecha_contrato']);
        $cursos_id = mysqli_real_escape_string($con, $_POST['cursos_id']);

        // Construir la consulta SQL para actualizar los datos del profesor en la tabla 'profesores' de la base de datos
        $query = "UPDATE profesores SET nombre='$nombre', apellido='$apellido', correo='$correo', telefono='$telefono', salario='$salario', fecha_contrato='$fecha_contrato', cursos_id='$cursos_id' WHERE id=$id";

        // Ejecutar la consulta SQL utilizando mysqli_query()
        if (mysqli_query($con, $query)) {
            // Cerrar la conexión a la base de datos
            mysqli_close($con);
            // Redireccionar a la página anterior (página de agregar profesores)
            header("Location: agregar.php");
            // Asegurar que el script se detiene después de la redirección
            exit();
        } else {
            // Mostrar un mensaje de error y detener el script si ocurre algún error durante la ejecución de la consulta SQL
            die("Error al actualizar los datos: " . mysqli_error($con));
        }
    }
} else {
    // Mostrar un mensaje de error y detener el script si la solicitud no es del tipo POST o si no se proporciona el campo 'id'
    die("Acceso inválido.");
}
