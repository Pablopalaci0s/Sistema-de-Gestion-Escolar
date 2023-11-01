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
    
    

</head>
<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $isbn = $_POST["isbn"];
    $cantidad = $_POST["cantidad"];
    $foto_libro = $_POST["foto_libro"];

    $sql = "INSERT INTO libros (titulo, isbn, cantidad_disponible, foto_libro) VALUES ('$titulo', '$isbn', '$cantidad', '$foto_libro')";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin_libros.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administrador - Agregar Libro</title>
</head>
<body>
    <h1>Agregar Libro</h1>
    <a href="admin_libros.php">Volver a la Lista de Libros</a>
    <form method="post">
        <label>Título:</label>
        <input type="text" name="titulo" required><br>
        <label>ISBN:</label>
        <input type="text" name="isbn" required><br>
        <label>Cantidad Disponible:</label>
        <input type="number" name="cantidad" required><br>
        <label>Foto del Libro (URL):</label>
        <input type="text" name="foto_libro"><br>
        <input type="submit" value="Agregar">
    </form>
</body>
</html>
