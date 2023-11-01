<?php
require_once '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    if ($con->connect_error) {
        die("Error de conexión a la base de datos: " . $con->connect_error);
    }

    $score = $_POST['score'];
    $subjectId = $_POST['subject'];
    // $fecha = $_POST['Fecha de registro'];

    // Actualizar el registro en la base de datos
    $query = "UPDATE score SET score = ?, id_subject = ? WHERE id = ?";

    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param("sii", $score, $subjectId, $id);

        if ($stmt->execute()) {
            echo "Registro actualizado correctamente.";
            echo "<script>
            setTimeout(function() {
                alert('Notas editadas exitosamente.');
                window.history.back(); // Redirige a la página anterior
            }, 2000); // 2000 milisegundos (2 segundos)
        </script>";
        } else {
            echo "Error al actualizar el registro: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $con->error;
    }

    $con->close();
} else {
    echo "Solicitud incorrecta.";
}
