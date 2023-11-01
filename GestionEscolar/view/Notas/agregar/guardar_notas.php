<?php
// Quitar esto,solo para comprobar que envia datos en POST
//  var_dump($_POST);

// ASPECTOS A MEJORA, que la nota no pueda pasar más de 10...además que muestre un mensaje obligatorio de llenado de datos

include_once("../db/db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Datos en POST
    $student_id = $_POST["student"];
    $score = $_POST["score"];
    $subjectid = $_POST["subjectid"];

    // Validación y escape de datos aquí

    $query = "INSERT INTO score (student_id, score, id_subject, date_register) VALUES (?, ?, ?, NOW() )";
    $stmt = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($stmt, "isi", $student_id, $score, $subjectid);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Notas registradas exitosamente.";
    } else {
        echo "Error al registrar las notas.";
    }

    mysqli_stmt_close($stmt);
}
