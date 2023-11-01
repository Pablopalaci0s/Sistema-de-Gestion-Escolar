<?php
ob_start();
include "../models/conexion.php";

// Iniciar sesión si aún no se ha hecho
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el estudiante ha iniciado sesión
if (!isset($_SESSION["estudiante_id"])) {
    header("Location: login.php");
    exit();
}

$estudiante_id = intval($_SESSION["estudiante_id"]); // Validar y convertir a entero

// Obtener nombre del estudiante de manera segura
$sql = "SELECT nombre FROM estudiantes_login WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $estudiante_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Estudiante no encontrado. Por favor, inicie sesión nuevamente.";
    exit();
}

$estudiante = $result->fetch_assoc();
$nombre_estudiante = $estudiante["nombre"];

// Obtener libros prestados de manera segura
$sql = "SELECT prestamos.*, libros.titulo, libros.isbn
        FROM prestamos 
        INNER JOIN libros ON prestamos.id_libro = libros.id 
        WHERE prestamos.id_estudiante = ? AND prestamos.fecha_devolucion IS NULL";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $estudiante_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../resources/css/estudiantes.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap">
    <title>Libros Prestados - Estudiante</title>
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
</head>
<body>

<header>
    <a href="./biblioteca_estudiante.php" class="logo"><i class="ri-home-line"></i><span>Biblioteca</span></a>
    <ul class="navbar">
        <li><a href="../controllers/biblioteca_estudiante.php" class="active">Home</a></li>
        <li><a href="../controllers/libros_prestados.php">Prestamos</a></li>
    </ul>
    <div class="main">
        <a href="../controllers/login.php" class="user"><i class="ri-user-fill"></i>Cerrar Sesión</a>
   
    </div>
</header>




<h3>Libros Prestados:</h3>
<table border="1">
    <tr>
        <th>Título</th>
        <th>ISBN</th>
        <th>Fecha de Préstamo</th>
        <th>Acciones</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["titulo"] . "</td>";
            echo "<td>" . $row["isbn"] . "</td>";
            echo "<td>" . $row["fecha_prestamo"] . "</td>";
            echo "<td>";
            echo "<form method='post' style='display: inline-block;' onsubmit=\"return confirm('¿Estás seguro de que deseas devolver este libro?');\">";
            echo "<input type='hidden' name='prestamo_id' value='" . $row["id"] . "'>";
            echo "<input type='hidden' name='libro_id' value='" . $row["id_libro"] . "'>";
            echo "<input type='hidden' name='estudiante_id' value='" . $estudiante_id . "'>";
            echo "<input type='submit' name='devolver_libro' value='Devolver'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No tienes libros prestados actualmente.</td></tr>";
    }
    ?>
</table>
</body>
</html>

<?php
if (isset($_POST["devolver_libro"]) && isset($_POST["prestamo_id"]) && isset($_POST["libro_id"]) && isset($_POST["estudiante_id"])) {
    $prestamo_id = intval($_POST["prestamo_id"]); // Validar y convertir a entero
    $libro_id = intval($_POST["libro_id"]);
    $estudiante_id = intval($_POST["estudiante_id"]);
    $fecha_devolucion = date("Y-m-d");

    // Actualizar la fecha de devolución en el registro de préstamo de manera segura
    $sql = "UPDATE prestamos SET fecha_devolucion = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $fecha_devolucion, $prestamo_id);
    
    if ($stmt->execute()) {
        // Actualizar la cantidad disponible del libro en la tabla libros de manera segura
        $sql = "UPDATE libros SET cantidad_disponible = cantidad_disponible + 1 WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $libro_id);
        
        if ($stmt->execute()) {
            header("Location: libros_prestados.php?id=$estudiante_id");
            exit();
        } else {
            echo "Error al actualizar la cantidad disponible del libro: " . $conn->error;
        }
    } else {
        echo "Error al registrar la devolución del libro: " . $conn->error;
    }
}
?>

