<?php
// Configde conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// conexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar 
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Consulta 
$sql = "SELECT id, titulo, inicio, fin FROM eventos";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error en la consulta: " . $conn->error);
}

// ejecuta consulta
$stmt->execute();

// almacenar los resultados 
$result = $stmt->get_result();
$events = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $event = array(
            "id" => $row["id"],
            "title" => $row["titulo"],
            "start" => $row["inicio"],
            "end" => $row["fin"]
        );
        $events[] = $event;
    }
}

// Cerrar la conexión
$stmt->close();
$conn->close();

// Devolver los eventos en formato JSON
header("Content-Type: application/json");
echo json_encode($events);
?>
