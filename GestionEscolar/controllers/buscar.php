<!DOCTYPE html>
<html>
<head>
    <title>Resultados de la Búsqueda</title>
    <link rel="stylesheet" href="../resources/css/buscar.css">
</head>
<body>
    <?php
    // Comprobar si la solicitud es del tipo POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener el nombre del curso enviado a través de la solicitud POST y almacenarlo en la variable $curso
        $curso = $_POST['curso'];

        // Establecer una conexión a la base de datos MySQL
        $con = mysqli_connect("localhost", "root", "", "users");
        // Verificar si ha ocurrido un error en la conexión a la base de datos
        if (mysqli_connect_errno()) {
            // Mostrar un mensaje de error y detener el script si ha ocurrido un error
            die("Error al conectar con la base de datos: " . mysqli_connect_error());
        }

        // Realizar la consulta SQL para buscar los profesores por el curso
        $query = "SELECT * FROM profesores WHERE cursos LIKE '%$curso%'";
        $result = mysqli_query($con, $query);

        // Mostrar los resultados de la búsqueda
        if (mysqli_num_rows($result) > 0) {
            // Mostrar una tabla con los resultados encontrados
            echo "<h2>Resultados de la Búsqueda</h2>";
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Salario</th>
                        <th>Fecha Contrato</th>
                        <th>Cursos que imparte</th>
                        <th>Acciones</th>
                    </tr>";

            // Iterar sobre los resultados de la consulta y mostrar cada profesor en una fila de la tabla
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['apellido'] . "</td>";
                echo "<td>" . $row['correo'] . "</td>";
                echo "<td>" . $row['telefono'] . "</td>";
                echo "<td>" . $row['salario'] . "</td>";
                echo "<td>" . $row['fecha_contrato'] . "</td>";
                echo "<td>" . $row['cursos'] . "</td>";
                echo "<td><a href='editar.php?id=" . $row['id'] . "'>Editar</a> | <a href='eliminar.php?id=" . $row['id'] . "'>Eliminar</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            // Mostrar un mensaje si no se encontraron profesores que imparten el curso especificado
            echo "<p>No se encontraron profesores que imparten el curso '$curso'.</p>";
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($con);
    }
    ?>
    <!-- Botón para regresar a la página anterior -->
    <button onclick="goBack()">Regresar</button>

    <script>
        // Función para regresar a la página anterior
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
