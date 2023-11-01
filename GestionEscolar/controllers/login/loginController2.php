<?php
require_once('../../models/modelo.php'); // Modelo
require_once('../../view/config.php'); // Configuración
$db = $GLOBALS['db']; // Conexión desde config.php

$userModel = new UserModel($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $usuario_data = $userModel->getUserByUsername($usuario);

    if ($usuario_data && password_verify($contrasena, $usuario_data['contraseña'])) {
        $_SESSION['usuario_id'] = $usuario_data['id'];
        $_SESSION['usuario_cargo'] = $usuario_data['id_cargo'];

        switch ($usuario_data['id_cargo']) {
            case 1:
                header("location: ../../view/admin.php");
                break;
            case 2:
                header("location: ../../view/cliente.php");
                // Por el momento aún no se han desarrollado estas vistas
                break;
            case 3:
                header("location: ../../view/bibliotecario.php");
                // Por el momento aún no se han desarrollado estas vistas
                break;
            case 4:
                header("location: ../profesores.php");
                break;
            default:
                echo "<div class=\"alerta\">Error al iniciar sesión <br> Nombre y/o contraseña incorrectos.</div>";
                break;
        }
    } else {
        echo include("../../controllers/loginController2.php");
        echo "<div class=\"alerta\">Error al iniciar sesión <br> Nombre y/o contraseña incorrectos.</div>";
    }
}
?>
