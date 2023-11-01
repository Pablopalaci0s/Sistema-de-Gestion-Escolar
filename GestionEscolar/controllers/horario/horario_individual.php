<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../resources/css/horario.css">
    <title>Horario Individual</title>
</head>
<body>
    <div class="horario-container">
        <?php
        // Verifica si se ha enviado el formulario
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["grado"]) && isset($_GET["seccion"])) {
            // Obtén los valores del grado y sección desde la URL
            $grado = $_GET["grado"];
            $seccion = $_GET["seccion"];

            // Realiza la conexión a la base de datos (Asegúrate de configurar tus credenciales)
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "users";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Error de conexión a la base de datos: " . $conn->connect_error);
            }

            // Consulta la base de datos para obtener los horarios correspondientes
            $sql = "SELECT * FROM horario WHERE grado = '$grado' AND seccion = '$seccion' ORDER BY dia, hora_inicio";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $currentDay = "";
                echo "<h2>Horario para $grado - $seccion</h2>";
                while ($row = $result->fetch_assoc()) {
                    if ($currentDay != $row["dia"]) {
                        if ($currentDay != "") {
                            echo "</tbody></table><br>"; // Cerrar la tabla del día anterior
                        }
                        echo "<h3>" . $row["dia"] . "</h3>"; // Mostrar el nuevo día
                        echo "<table>";
                        echo "<thead><tr><th>Hora</th><th>Materia</th></tr></thead>";
                        echo "<tbody>";
                        $currentDay = $row["dia"];
                    }
                    echo "<tr>";
                    echo "<td>" . $row["hora_inicio"] . " - " . $row["hora_fin"] . "</td>";
                    echo "<td>" . $row["materia"] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "No se encontraron horarios para $grado - $seccion.";
            }
while ($row = $result->fetch_assoc()) {
    if ($currentDay != $row["dia"]) {
        if ($currentDay != "") {
            echo "</tbody></table><br>"; // Cerrar la tabla del día anterior
        }
        echo "<h3>" . $row["dia"] . "</h3>"; // Mostrar el nuevo día
        echo "<table>";
        echo "<thead><tr><th>Hora</th><th>Materia</th><th>Acciones</th></tr></thead>";
        echo "<tbody>";
        $currentDay = $row["dia"];
    }
    echo "<tr>";
    echo "<td>" . $row["hora_inicio"] . " - " . $row["hora_fin"] . "</td>";
    echo "<td>" . $row["materia"] . "</td>";
    echo "<td><form method='POST' action='eliminar_horario.php'>
              <input type='hidden' name='horario_id' value='" . $row["id"] . "'>
              <input type='submit' value='Eliminar'>
              </form></td>";
    echo "</tr>";
}
echo "</tbody></table>";

            // Cierra la conexión a la base de datos
            $conn->close();
        } else {
            echo "Error: No se proporcionaron datos válidos.";
        }
        ?>
        <br>
        <button onclick="history.go(-1)">Volver</button> <!-- Botón para regresar a la página anterior -->
    </div>
</body>
</html>
