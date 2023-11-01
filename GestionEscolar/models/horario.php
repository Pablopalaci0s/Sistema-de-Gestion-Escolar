<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Horarios</title>
    <link rel="stylesheet" href="../css/horarioo.css">
</head>
<body>
    <h1>Crear Horario Escolar</h1>
    <form action="registrar_horario.php" method="POST">
        <label for="grado">Grado:</label>
        <select name="grado" required>
            <?php
            // Conexión a la base de datos (Asegúrate de configurar tus credenciales)
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "users";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Error de conexión a la base de datos: " . $conn->connect_error);
            }

            // Consulta para obtener los grados disponibles de la tabla estudiantes
            $sql = "SELECT DISTINCT grado FROM estudiantes";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["grado"] . "'>" . $row["grado"] . "</option>";
                }
            }

            $conn->close();
            ?>
        </select><br>

        <label for="seccion">Sección:</label>
        <select name="seccion" required>
            <?php
            // Conexión a la base de datos (Asegúrate de configurar tus credenciales)
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Error de conexión a la base de datos: " . $conn->connect_error);
            }

            // Consulta para obtener las secciones disponibles de la tabla estudiantes
            $sql = "SELECT DISTINCT seccion FROM estudiantes";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["seccion"] . "'>" . $row["seccion"] . "</option>";
                }
            }

            $conn->close();
            ?>
        </select><br>

        <label for="dia">Día:</label>
        <input type="text" name="dia" required><br>

        <label for="hora_inicio">Hora de Inicio:</label>
        <input type="time" name="hora_inicio" required><br>

        <label for="hora_fin">Hora de Fin:</label>
        <input type="time" name="hora_fin" required><br>

        <div id="calendario">
            <h2>Calendario Escolar</h2>
            <table>
                <thead>
                    <tr>
                        <th>Hora</th>
                        <th>Materia</th>
                    </tr>
                </thead>
                <tbody>
    <?php
    // Crear filas para cada hora del día
    for ($i = 1; $i <= 8; $i++) {
        echo "<tr>";
        echo "<td><input type='time' name='hora[]' required></td>";
        echo "<td><div class='materia-container'><input type='text' name='materia[]' required></div></td>";
        echo "</tr>";
    }
    ?>
</tbody>


            </table>
        </div>

        <input type="submit" value="Guardar Horario">
    </form>
</body>
</html>
