<?php
include_once("../db/db.php");

if (!empty($_POST["id"]) && !empty($_POST['sid'])) {
    $id = $_POST['id'];
    $sid = $_POST['sid'];

    // Utilizamos consultas preparadas para evitar inyecciones SQL
    $query = "SELECT  * FROM estudiantes WHERE id_section = ? AND id_grade = ?";
    $stmt = mysqli_prepare($con, $query);
    
    // Asociamos los parámetros a la consulta preparada
    mysqli_stmt_bind_param($stmt, "ii", $id, $sid);

    // Ejecutamos la consulta preparada
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo '<option value="">Seleccionar estudiante</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
        }
    } else {
        echo '<option value="">No students found</option>';
    }
} else {
    echo '<option value="">Invalid data</option>';
}

// Cerramos la consulta preparada
mysqli_stmt_close($stmt);
?>
