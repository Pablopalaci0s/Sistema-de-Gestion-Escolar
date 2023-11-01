<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Horario por Fecha</title>
    <link rel="stylesheet" href="../../resources/css/normalize.css">
    <link rel="stylesheet" href="../../resources/css/estilos.css">
    <link rel="stylesheet" href="../../resources/css/style.css">
</head>
<body>
    <h1>Buscar Horario por Fecha</h1>

    <!-- Formulario de búsqueda por fecha -->
    <form action="buscar_horario.php" method="post">
        <label for="fecha">Buscar por fecha:</label>
        <input type="date" name="fecha" required>
        <input type="submit" value="Buscar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fecha = $_POST['fecha'];

        // Conectar a la base de datos
        $con = mysqli_connect("localhost", "root", "", "users");
        if (mysqli_connect_errno()) {
            die("Error al conectar con la base de datos: " . mysqli_connect_error());
        }

        // Obtener la lista de horarios por fecha
        $query = "SELECT horarios.*, profesores.nombre AS nombre_profesor 
                  FROM horarios 
                  INNER JOIN profesores ON horarios.id_profesor = profesores.id 
                  WHERE horarios.fecha = '$fecha'";
        $result = mysqli_query($con, $query);

        // Mostrar la tabla de horarios encontrados
        echo "<h2>Horarios encontrados para la fecha: $fecha</h2>";
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Profesor</th>
                    <th>Acciones</th>
                </tr>";

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['fecha'] . "</td>";
            echo "<td>" . $row['hora_inicio'] . "</td>";
            echo "<td>" . $row['hora_fin'] . "</td>";
            echo "<td>" . $row['nombre_profesor'] . "</td>";
            echo "<td><a href='editar_horario.php?id=" . $row['id'] . "'>Editar</a> | <a href='eliminar_horario.php?id=" . $row['id'] . "'>Eliminar</a></td>";
            echo "</tr>";
        }

        echo "</table>";

        mysqli_close($con);
    }
    ?>
    
</body>
</html>
