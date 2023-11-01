<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Realizar la consulta 
$sql_eventos = "SELECT id, titulo, inicio, fin FROM eventos";

// ejecutar consulta
$result_eventos = mysqli_query($conn, $sql_eventos);

// variable para almacenar la lista de eventos en formato html
$eventos_html = '';


if (mysqli_num_rows($result_eventos) > 0) {
    // mysqli_num_rows obtener numero de filas
    while ($row_evento = mysqli_fetch_assoc($result_eventos)) {
        $eventos_html .= "<li>";
        $eventos_html .= "<strong>" . $row_evento["titulo"] . "</strong><br>";
        $eventos_html .= "Fecha de inicio: " . $row_evento["inicio"] . "<br>";
        $eventos_html .= "Fecha de fin: " . $row_evento["fin"] . "<br>";
        $eventos_html .= '<button onclick="eliminarEvento(' . $row_evento["id"] . ')">Eliminar</button>';
        $eventos_html .= "</li>";
    }
} else {
    $eventos_html .= "<p>No se encontraron eventos.</p>";
}

// Cerrar la conexión 
mysqli_close($conn);

// Devolver la lista de eventos en formato HTML
echo $eventos_html;
?>
