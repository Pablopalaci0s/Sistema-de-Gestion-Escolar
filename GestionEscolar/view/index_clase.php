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

// Realizar una consulta SQL para obtener el nombre de la clase
$sql = "SELECT nombre FROM clases WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $clase_id);
$stmt->execute();
$stmt->bind_result($nombre_clase);
$stmt->fetch();
$stmt->close();

// Consulta SQL para obtener los comentarios y los nombres de los estudiantes
$sqlComentarios = "SELECT comentarios.id, comentarios.comentario, comentarios.fecha, estudiantes_login.nombre
                   FROM comentarios
                   JOIN estudiantes_login ON comentarios.estudiante_id = estudiantes_login.id
                   WHERE comentarios.clase_id = ?";

$stmtComentarios = $conn->prepare($sqlComentarios);
$stmtComentarios->bind_param("i", $clase_id);
$stmtComentarios->execute();
$resultComentarios = $stmtComentarios->get_result();

// Verificar si el usuario ha iniciado sesión, de lo contrario, redirigir a la página de inicio de sesión
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

// Consulta SQL para obtener las clases
$sqlClases = "SELECT * FROM clases";

// Ejecutar la consulta de las clases
$resultClases = $conn->query($sqlClases);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clase - <?php echo $nombre_clase; ?></title>
    <link rel="stylesheet" href="../resources/css/index_clase.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../resources/css/classroom.css">
</head>
<body>
<nav class="navbar">
      <div class="logo">
        <img src="../resources/img/logoo2.png" />
        <h2>Bright Horizon Academy</h2>
      </div>
      <div class="links">
      <a href="../view/vista_classroom.php">Inicio</a>
        <div class="dropdown">
          <a href="#"
            >Explore
            <img src="../resources/img/chevron.png" />
          </a>
          <div class="menu">
            <a href="../view/crear_clase.php"> Crea una clase! </a>
           
            
          </div>
        </div>
        <a href="../view/classroom.php" class="join-link"> Cerrar Sesión </a>
      </div>
    </nav>
    <br><br><br><br><br>
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
