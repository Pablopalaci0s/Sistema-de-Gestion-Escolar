<?php
// Veificar que el parámetro "id" es numérico
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
   
    $id_evento_a_eliminar = $_GET["id"];

    // conexión
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "users";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Veificar conexión 
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Utlizar una sentencia  para eliminar el evento 
    $sql_eliminar_evento = "DELETE FROM eventos WHERE id = ?";
    $stmt = $conn->prepare($sql_eliminar_evento);
    $stmt->bind_param("i", $id_evento_a_eliminar);

    if ($stmt->execute()) {
        $response = array("status" => "success", "message" => "Evento eliminado correctamente.");
    } else {
        $response = array("status" => "error", "message" => "Error al eliminar el evento: " . $stmt->error);
    }

    // Cerrar la sentencia preparada y la conexión a la base de datos
    $stmt->close();
    $conn->close();

}
?>
