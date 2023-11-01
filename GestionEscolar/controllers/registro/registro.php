<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexion = mysqli_connect("localhost", "root", "", "users");

    if (!$conexion) {
        die("La conexión falló: " . mysqli_connect_error());
    }

    $nombre = $_POST['nombre'];
    $cargo = $_POST['cargo'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    // Verificar si el usuario ya existe en la base de datos
    $consulta_existencia = "SELECT * FROM usuarios WHERE nombre = ?";
    $stmt_existencia = mysqli_prepare($conexion, $consulta_existencia);
    mysqli_stmt_bind_param($stmt_existencia, "s", $nombre);
    mysqli_stmt_execute($stmt_existencia);
    $resultado_existencia = mysqli_stmt_get_result($stmt_existencia);

    if (mysqli_num_rows($resultado_existencia) > 0) {
        echo "El usuario ya existe en la base de datos.";
    } else {
        // Insertar el usuario si no existe
        $consulta_insertar = "INSERT INTO usuarios (nombre, usuario, contraseña, id_cargo) VALUES (?, ?, ?, ?)";
        $stmt_insertar = mysqli_prepare($conexion, $consulta_insertar);
        mysqli_stmt_bind_param($stmt_insertar, "sssi", $nombre, $nombre, $contrasena, $cargo);

        if (mysqli_stmt_execute($stmt_insertar)) {
            echo "Usuario registrado exitosamente.";
        } else {
            echo "Error al registrar el usuario: " . mysqli_error($conexion);
        }

        mysqli_stmt_close($stmt_insertar);
    }

    mysqli_stmt_close($stmt_existencia);
    mysqli_close($conexion);
}
?>
