<?php
session_start();
include "../models/conexion.php"; // Asegúrate de incluir tu archivo de conexión

// Verifica si el usuario ha iniciado sesión, de lo contrario, redirigir a la página de inicio de sesión
if (!isset($_SESSION["estudiante_id"])) {
    header("Location: login.php");
    exit();
}

// Obtener información de la clase desde la base de datos (reemplaza $clase_id con el ID de la clase actual)
$clase_id = $_GET["id"]; // Suponiendo que pasas el ID de la clase como parámetro en la URL

// Realizar una consulta SQL para obtener los detalles de la clase
$sql = "SELECT nombre, grado, seccion, clave_acceso, tutor_id, clave_admin FROM clases WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $clase_id);

if ($stmt->execute()) {
    $stmt->bind_result($nombre_clase, $grado, $seccion, $clave_acceso, $tutor_id, $clave_admin);
    $stmt->fetch();
    $stmt->close();
} else {
    // Manejo de errores en caso de que la consulta falle
    die("Error al obtener detalles de la clase: " . $stmt->error);
}

// Consulta SQL para obtener los comentarios y los nombres de los estudiantes
$sqlComentarios = "SELECT comentarios.id, comentarios.comentario, comentarios.fecha, estudiantes_login.nombre
                   FROM comentarios
                   JOIN estudiantes_login ON comentarios.estudiante_id = estudiantes_login.id
                   WHERE comentarios.clase_id = ?";

$stmtComentarios = $conn->prepare($sqlComentarios);
$stmtComentarios->bind_param("i", $clase_id);
$stmtComentarios->execute();
$resultComentarios = $stmtComentarios->get_result();

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clase - <?php echo $nombre_clase; ?></title>
    <link rel="stylesheet" href="../resources/css/index_clase.css">
</head>
<body>
    <header>
        <span class="logo"><i class="ri-home-line"></i><span>Aula Virtual</span></span>
        <ul class="navbar">
            <li><a href="../view/vista_classroom.php">Inicio</a></li>
            <a href="javascript:void(0);" onclick="mostrarFormularioBusqueda()" >Unete!</a>
            <li><a href="../view/crear_clase.php">Crear!</a></li>
        </ul>
        <div class="main">
            <a href="../controllers/login.php" class="user"><i class="ri-user-fill"></i>   <span>Bienvenido, <?php echo $nombreUsuario; ?></span></a>
        </div>
    </header>
    <div class="container">
        <h2>Clase - <?php echo $nombre_clase; ?></h2>

        <!-- Formulario para dejar un comentario -->
        <h3>Dejar un Comentario</h3>
        <form action="procesar_comentario.php" method="post">
            <textarea name="comentario" rows="4" cols="50" required></textarea>
            <input type="hidden" name="clase_id" value="<?php echo $clase_id; ?>">
            <input type="submit" value="Enviar Comentario">
        </form>

        <!-- Mostrar los comentarios y nombres de los estudiantes -->
        <h3>Comentarios</h3>
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
    </div>
</body>
</html>
