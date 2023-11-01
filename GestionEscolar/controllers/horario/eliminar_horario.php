<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $con = mysqli_connect("localhost", "root", "", "users");
    if (mysqli_connect_errno()) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    $query = "DELETE FROM horarios WHERE id = $id";
    if (mysqli_query($con, $query)) {
        header("Location: buscar_horario.php");
        exit;
    } else {
        echo "Error al eliminar el horario: " . mysqli_error($con);
    }

    mysqli_close($con);
}
?>
