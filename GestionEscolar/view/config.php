<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "users";

$db = new mysqli($servername, $username, $password, $database);

if ($db->connect_error) {
    die("La conexión a la base de datos falló: " . $db->connect_error);
}
?>
