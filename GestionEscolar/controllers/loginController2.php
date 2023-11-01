<?php
require_once('../../models/modelo.php'); //model
require_once('../../view/config.php'); // el modelo
$db = $GLOBALS['db']; // conexion desde config.php

$userModel = new UserModel($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $usuario_data = $userModel->getUserByUsername($usuario);

    if ($usuario_data && password_verify($contrasena, $usuario_data['contraseña'])) {
        $_SESSION['usuario_id'] = $usuario_data['id'];
        $_SESSION['usuario_cargo'] = $usuario_data['id_cargo'];

        if ($usuario_data['id_cargo'] == 1) {
            header("location: ../../view/admin.php");
        } elseif ($usuario_data['id_cargo'] == 2) {
            header("location: ../../view/cliente.php");
            // Por el momento aún no se han desarrollado estas vistas
        } elseif ($usuario_data['id_cargo'] == 3) {
            header("location: bibliotecario_dashboard.php");
                        // Por el momento aún no se han desarrollado estas vistas
        } elseif ($usuario_data['id_cargo'] == 4) {
            header("location: ../profesores.php");
        }
    } else {
       echo include("../view/login.html");
        echo "<div class=\"alerta\">Credenciales inválidas. <br> Por favor, inténtelo nuevamente.</div>";
    }
}
?>
