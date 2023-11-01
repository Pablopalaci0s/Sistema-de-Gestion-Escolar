<?php
// Comprobar si la solicitud es del tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del profesor desde la solicitud POST y almacenarlos en variables
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $salario = $_POST["salario"];
    $fecha_contrato = $_POST["fecha_contrato"];
    $cursos = $_POST["cursos"];

    // Validar que todos los campos estén completos
    if (empty($nombre) || empty($apellido) || empty($correo) || empty($telefono) || empty($salario) || empty($fecha_contrato) || empty($cursos)) {
        // Mostrar un mensaje de error y detener el script si algún campo está vacío
        die("Error al agregar el profesor: Todos los campos son obligatorios.");
    }

    // Validar el formato del correo electrónico
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        // Mostrar un mensaje de error y detener el script si el correo electrónico no es válido
        die("Error al agregar el profesor: El correo electrónico ingresado no es válido.");
    }

    // Validar el número de teléfono (por ejemplo, 10 dígitos numéricos)
    if (!preg_match("/^\d{8}$/", $telefono)) {
        // Mostrar un mensaje de error y detener el script si el número de teléfono no es válido
        die("Error al agregar el profesor: El número de teléfono ingresado no es válido.");
    }

    // Validar el salario (debe ser un número mayor que cero)
    if (!is_numeric($salario) || $salario <= 0) {
        // Mostrar un mensaje de error y detener el script si el salario no es válido
        die("Error al agregar el profesor: El salario ingresado no es válido.");
    }

    // Validar la fecha de contrato (debe tener el formato 'YYYY-MM-DD')
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $fecha_contrato)) {
        // Mostrar un mensaje de error y detener el script si la fecha de contrato no es válida
        die("Error al agregar el profesor: La fecha de contrato ingresada no es válida.");
    }

    // Establecer una conexión a la base de datos MySQL
    $con = mysqli_connect("localhost", "root", "", "users");
    // Verificar si ha ocurrido un error en la conexión a la base de datos
    if (mysqli_connect_errno()) {
        // Mostrar un mensaje de error y detener el script si ha ocurrido un error
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    // Escapar los datos para evitar inyección SQL
    $nombre = mysqli_real_escape_string($con, $nombre);
    $apellido = mysqli_real_escape_string($con, $apellido);
    $correo = mysqli_real_escape_string($con, $correo);
    $telefono = mysqli_real_escape_string($con, $telefono);
    $salario = mysqli_real_escape_string($con, $salario);
    $fecha_contrato = mysqli_real_escape_string($con, $fecha_contrato);
    $cursos = mysqli_real_escape_string($con, $cursos);

    // Insertar el nuevo profesor en la base de datos
    $query = "INSERT INTO profesores (nombre, apellido, correo, telefono, salario, fecha_contrato, cursos) VALUES ('$nombre', '$apellido', '$correo', '$telefono', '$salario', '$fecha_contrato', '$cursos')";
    if (mysqli_query($con, $query)) {
        // Mostrar un mensaje de éxito si el profesor fue agregado correctamente
        echo "Profesor agregado correctamente.";
    } else {
        // Mostrar un mensaje de error si ha ocurrido algún problema durante la inserción en la base de datos
        echo "Error al agregar el profesor: " . mysqli_error($con);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($con);
}
?>
