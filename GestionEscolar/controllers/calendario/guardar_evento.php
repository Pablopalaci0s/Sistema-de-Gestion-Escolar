<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// Obtener
// isset verificar que titulo esta en post
// ? en caso de ser asi ejecutar lo de la derecha
// trim se toma el valor y se elinarn los espacios en blanco 
$titulo = isset($_POST['titulo']) ? trim($_POST['titulo']) : "";
$inicio = isset($_POST['inicio']) ? trim($_POST['inicio']) : "";
$fin = isset($_POST['fin']) ? trim($_POST['fin']) : "";

// Validar campos para no estar vacios
if (empty($titulo) || empty($inicio) || empty($fin)) {
    echo "Todos los campos son requeridos.";
    exit;
}

// conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Consulta  para insertar el nuevo evento 
$sql = "INSERT INTO eventos (titulo, inicio, fin) VALUES (?, ?, ?)";

// prepara consulta
$stmt = $conn->prepare($sql);

// vinclar parámetros / ejecutar  consulta
$stmt->bind_param("sss", $titulo, $inicio, $fin);
// bind_param se usa para vincular de forma segura los valores proporcionados
// sss significa cada uno STRING, lo que se va a evaluar

if ($stmt->execute()) {
    echo "<script>alert('Evento guardado exitosamente.');</script>";
} else {
    echo "<script>alert('Error al guardar el evento: " . $conn->error . "');</script>";
}
// Cerrar la conexión 
$stmt->close();
$conn->close();
?>
