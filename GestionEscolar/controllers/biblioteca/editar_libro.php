
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="./css/biblioteca.css">
    <link rel="stylesheet" href="../administradores/css/style.css">
    
    

</head><?php
include "conexion.php";

// Verificar si se ha recibido el parámetro "id" en la URL
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id_libro = $_GET["id"];
} else {
    header("Location: admin_libros.php");
    exit();
}

// Obtener la información del libro de la base de datos
$sql = "SELECT * FROM libros WHERE id = $id_libro";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    // Si no se encuentra el libro con el ID proporcionado, redirigir al listado de libros
    header("Location: admin_libros.php");
    exit();
}

// Procesar los cambios cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $isbn = $_POST["isbn"];
    $cantidad = $_POST["cantidad"];
    $foto_libro = $_POST["foto_libro"];

    // Actualizar la información del libro en la base de datos
    $sql = "UPDATE libros SET titulo = '$titulo', isbn = '$isbn', cantidad_disponible = '$cantidad', foto_libro = '$foto_libro' WHERE id = $id_libro";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin_libros.php");
        exit();
    } else {
        echo "Error al actualizar el libro: " . $conn->error;
    }
}

// Obtener la información del libro para mostrarla en el formulario
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administrador - Editar Libro</title>
</head>
<body>
    <h1>Editar Libro</h1>
    <a href="admin_libros.php">Volver a la Lista de Libros</a>
    <form method="post">
        <label>Título:</label>
        <input type="text" name="titulo" value="<?php echo $row["titulo"]; ?>" required><br>
        <label>ISBN:</label>
        <input type="text" name="isbn" value="<?php echo $row["isbn"]; ?>" required><br>
        <label>Cantidad Disponible:</label>
        <input type="number" name="cantidad" value="<?php echo $row["cantidad_disponible"]; ?>" required><br>
        <label>Foto del Libro (URL):</label>
        <input type="text" name="foto_libro" value="<?php echo $row["foto_libro"]; ?>"><br>
        <input type="submit" value="Guardar Cambios">
    </form>
</body>
</html>
