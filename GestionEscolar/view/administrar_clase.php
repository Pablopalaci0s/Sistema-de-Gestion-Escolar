<?php
session_start();
include "../models/conexion.php"; // Asegúrate de incluir tu archivo de conexión

// Verifica si el usuario ha iniciado sesión, de lo contrario, redirige a la página de inicio de sesión
if (!isset($_SESSION["estudiante_id"])) {
    header("Location: login.php");
    exit();
}

// Función para obtener el nombre del usuario desde la base de datos
function obtenerNombreUsuario($conn, $estudiante_id) {
    // Consultar la base de datos para obtener el nombre del usuario
    $sql = "SELECT nombre FROM estudiantes_login WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $estudiante_id);
    $stmt->execute();
    $stmt->bind_result($nombre);
    $stmt->fetch();
    $stmt->close();

    return $nombre;
}

// Conectar a la base de datos (debes configurar tus propios datos de conexión)
$conn = new mysqli("localhost", "root", "", "users");

// Verificar la conexión a la base de datos
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$nombreUsuario = obtenerNombreUsuario($conn, $_SESSION["estudiante_id"]);

// Obtener el ID de la clase desde la URL
if (isset($_GET["id"])) {
    $clase_id = $_GET["id"];
} else {
    echo "ID de clase no especificado.";
    exit();
}

// Realizar una consulta SQL para obtener el nombre de la clase
$sql = "SELECT nombre FROM clases WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $clase_id);
$stmt->execute();
$stmt->bind_result($nombre_clase);
$stmt->fetch();
$stmt->close();

// Consulta SQL para obtener los comentarios de los estudiantes
$sqlComentarios = "SELECT comentarios.id, comentarios.comentario, comentarios.fecha, estudiantes_login.nombre
                   FROM comentarios
                   JOIN estudiantes_login ON comentarios.estudiante_id = estudiantes_login.id
                   WHERE comentarios.clase_id = ?";

$stmtComentarios = $conn->prepare($sqlComentarios);
$stmtComentarios->bind_param("i", $clase_id);
$stmtComentarios->execute();
$resultComentarios = $stmtComentarios->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Clase - <?php echo $nombre_clase; ?></title>
    <link rel="stylesheet" href="../resources/css/classroom.css">
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar">
        <div class="navbar-left">
            <h1>Aula Virtual</h1>
        </div>
        <div class="navbar-right">
            <a href="../view/vista_classroom.php">Volver a Mis Clases</a>
        </div>
    </nav>

    <div class="container">
        <h2>Administración de Clase - <?php echo $nombre_clase; ?></h2>

        <!-- Administración de Comentarios -->
        <h3>Comentarios de Estudiantes</h3>
        <div class="comentarios-container">
            <?php
            while ($rowComentario = $resultComentarios->fetch_assoc()) {
                $comentario = $rowComentario['comentario'];
                $nombre_estudiante = $rowComentario['nombre'];
                $fecha_comentario = $rowComentario['fecha'];

                echo "<div class='comentario'>";
                echo "<p><strong>$nombre_estudiante:</strong> $comentario</p>";
                echo "<p>Fecha del comentario: $fecha_comentario</p>";
                echo "</div>";
            }
            ?>
        </div>

        <!-- Administración de Actividades para Estudiantes -->
        <h3>Actividades para Estudiantes</h3>
        <p>Aquí puedes agregar actividades para que los estudiantes las entreguen:</p>
        <form action="procesar_actividad.php" method="post">
            <textarea name="actividad" rows="4" cols="50" required></textarea>
            <input type="hidden" name="clase_id" value="<?php echo $clase_id; ?>">
            <input type="submit" value="Agregar Actividad">
        </form>
    </div>
</body>
</html>
