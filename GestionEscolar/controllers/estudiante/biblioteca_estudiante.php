<?php
ob_start();
// Iniciar la sesión
session_start();
// Verificar si el estudiante ha iniciado sesión
if (!isset($_SESSION["estudiante_id"])) {
    // Si no ha iniciado sesión, redirigir al usuario a la página de inicio de sesión
    header("Location: login.php");
    exit(); // Detener la ejecución del script
}
// Obtener el ID del estudiante desde el parámetro en la URL
$estudiante_id = $_SESSION["estudiante_id"];
// Incluir el archivo de conexión a la base de datos
include "../models/conexion.php";
// Consultar la base de datos para obtener el nombre del estudiante usando su ID
$sql = "SELECT nombre FROM estudiantes_login WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $estudiante_id);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si se encontró el estudiante en la base de datos
if ($result->num_rows === 0) {
    // Si no se encontró el estudiante, mostrar un mensaje de error y detener la ejecución
    echo "Estudiante no encontrado. Por favor, inicie sesión nuevamente.";
    exit();
}
// Obtener los detalles del estudiante desde el resultado de la consulta
$estudiante = $result->fetch_assoc();
$nombre_estudiante = $estudiante["nombre"];
// Obtener el término de búsqueda de libros de la URL (si está presente)
$search_query = isset($_GET['q']) ? $_GET['q'] : '';
$search_query = $conn->real_escape_string($search_query);
// Construir la consulta SQL para buscar libros con el término de búsqueda en el título
$search_sql = "SELECT * FROM libros WHERE titulo LIKE '%$search_query%'";
$search_result = $conn->query($search_sql);
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../resources/css/estudiantes.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap">
    <title>Biblioteca - Estudiante</title>
</head>

<body>
    <header>
        <span class="logo"><i class="ri-home-line"></i><span>Biblioteca</span></span>
        <ul class="navbar">
            <li><a href="./biblioteca_estudiante.php" class="active">Home</a></li>
            <li><a href="./libros_prestados.php">Prestamos</a></li>
        </ul>
        <div class="main">
        <a href="../registro/index.php" class="nav__links">Cerrar sesión</a>
        </div>
    </header>
    <h3>Buscar Libros:</h3>
    <form method="get" class="search-form">
        <input type="hidden" name="id" value="<?php echo $estudiante_id; ?>">
        <input type="text" name="q" id="search-input" placeholder="Buscar por título..." onkeyup="searchBooks()">
    </form>
    <h3>Lista de Libros Disponibles:</h3>
    <div class="libros-container">
        <?php
        if ($search_result->num_rows > 0) {
            while ($row = $search_result->fetch_assoc()) {
                echo "<div class='libro-recuadro' onmouseover='mostrarInformacion(this)' onmouseout='ocultarInformacion(this)'>";
                echo "<h4>" . $row["titulo"] . "</h4>";
                echo "<p>ISBN: " . $row["isbn"] . "</p>";
                echo "<p>Cantidad Disponible: " . $row["cantidad_disponible"] . "</p>";
                echo "<img src='" . $row["foto_libro"] . "' width='100' height='150' alt='XD'>";


                if ($row["cantidad_disponible"] > 0) {
                    echo "<form method='post' onsubmit=\"return confirm('¿Estás seguro de que deseas pedir este libro?');\">";
                    echo "<input type='hidden' name='id_libro' value='" . $row["id"] . "'>";
                    echo "<input type='hidden' name='estudiante_id' value='" . $estudiante_id . "'>";
                    echo "<input type='submit' name='pedir_libro' value='Pedir'>";
                    echo "</form>";
                } else {
                    echo "<p>No Disponible</p>";
                }

                echo "</div>";
            }
        } else {
            echo "<p>No se encontraron resultados.</p>";
        }
        ?>
    </div>
</body>

</html>
<script>
    function searchBooks() {
        var searchInput = document.getElementById('search-input');
        var searchValue = searchInput.value.toLowerCase();
        var libros = document.querySelectorAll('.libro-recuadro');

        for (var i = 0; i < libros.length; i++) {
            var titulo = libros[i].querySelector('h4').textContent.toLowerCase();
            if (titulo.includes(searchValue)) {
                libros[i].style.display = 'block';
            } else {
                libros[i].style.display = 'none';
            }
        }
    }
</script>
<?php
if (isset($_POST["pedir_libro"]) && isset($_POST["id_libro"]) && isset($_POST["estudiante_id"])) {
    $id_libro = $_POST["id_libro"];
    $estudiante_id = $_POST["estudiante_id"];
    $fecha_prestamo = date("Y-m-d");

    $sql = "SELECT * FROM prestamos WHERE id_estudiante = $estudiante_id AND id_libro = $id_libro AND fecha_devolucion IS NULL";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Ya tienes un préstamo pendiente para este libro.";
    } else {
        $sql = "INSERT INTO prestamos (id_estudiante, id_libro, fecha_prestamo) VALUES ($estudiante_id, $id_libro, '$fecha_prestamo')";

        if ($conn->query($sql) === TRUE) {
            $sql = "UPDATE libros SET cantidad_disponible = cantidad_disponible - 1 WHERE id = $id_libro";

            if ($conn->query($sql) === TRUE) {
                header("Location: biblioteca_estudiante.php?id=$estudiante_id");
                exit();
            } else {
                echo "Error al actualizar la cantidad disponible del libro: " . $conn->error;
            }
        } else {
            echo "Error al realizar el préstamo: " . $conn->error;
        }
    }
}
if (isset($_POST["devolver_libro"]) && isset($_POST["prestamo_id"]) && isset($_POST["libro_id"])) {
    $prestamo_id = $_POST["prestamo_id"];
    $libro_id = $_POST["libro_id"];
    $fecha_devolucion = date("Y-m-d");

    $sql = "UPDATE prestamos SET fecha_devolucion = '$fecha_devolucion' WHERE id = $prestamo_id";

    if ($conn->query($sql) === TRUE) {
        $sql = "UPDATE libros SET cantidad_disponible = cantidad_disponible + 1 WHERE id = $libro_id";

        if ($conn->query($sql) === TRUE) {
            header("Location: biblioteca_estudiante.php?id=$estudiante_id");
            exit();
        } else {
            echo "Error al actualizar la cantidad disponible del libro: " . $conn->error;
        }
    } else {
        echo "Error al registrar la devolución del libro: " . $conn->error;
    }
}
?>