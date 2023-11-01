<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Búsqueda</title>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <h1>Resultado de Búsqueda</h1>
    <?php
    if (isset($_GET['fecha']) && isset($_GET['mes'])) {
        $fecha = $_GET['fecha'];
        $mes = $_GET['mes'];

        $con = mysqli_connect("localhost", "root", "", "users");
        if (mysqli_connect_errno()) {
            die("Error al conectar con la base de datos: " . mysqli_connect_error());
        }

        $query = "SELECT * FROM horarios WHERE fecha = '$fecha' OR MONTH(fecha) = '$mes'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
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

                // Obtener el nombre del profesor
                $id_profesor = $row['id_profesor'];
                $query_profesor = "SELECT nombre FROM profesores WHERE id = $id_profesor";
                $result_profesor = mysqli_query($con, $query_profesor);
                $row_profesor = mysqli_fetch_array($result_profesor);

                echo "<td>" . $row_profesor['nombre'] . "</td>";
                echo "<td><a href='editar_horario.php?id=" . $row['id'] . "'>Editar</a> | <a href='eliminar_horario.php?id=" . $row['id'] . "'>Eliminar</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No se encontraron horarios para la fecha o mes especificados.";
        }

        mysqli_close($con);
    } else {
        echo "Debe especificar una fecha y un mes para realizar la búsqueda.";
    }
    ?>
    <br>
    <a href="buscar_horario.php">Volver a Buscar</a>
    <a href="agregar_horario.php">Agregar Horario</a>
</body>
</html>
