<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener la fecha actual
    $fecha = date('Y-m-d');

    // Obtener los datos del formulario
    $asistencia = $_POST['asistencia'];
    $id_estudiante = $_POST['id_estudiante'];

    // Conectar a la base de datos
    $con = mysqli_connect("localhost", "root", "", "users");
    if (mysqli_connect_errno()) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    // Escapar las comillas simples para evitar problemas con la consulta SQL
    $asistencia = mysqli_real_escape_string($con, $asistencia);
    $id_estudiante = mysqli_real_escape_string($con, $id_estudiante);

    // Insertar la asistencia en la base de datos
    $query = "INSERT INTO asistencias (fecha, asistencia, id_estudiante) 
              VALUES ('$fecha', '$asistencia', $id_estudiante)";
    if (mysqli_query($con, $query)) {
        header("Location: registrar_asistencia.php");
        exit;
    } else {
        echo "Error al registrar la asistencia: " . mysqli_error($con);
    }

    mysqli_close($con);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Asistencia de Estudiantes</title>
    <link rel="stylesheet" href="../administradores/css/style.css">
</head>
<body>
  
       
</body>
</html>
