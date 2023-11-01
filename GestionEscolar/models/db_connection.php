<?php
// Establecer la conexión a la base de datos
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'users';

$con = mysqli_connect($hostname, $username, $password, $database);
if (mysqli_connect_errno()) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}
?>
