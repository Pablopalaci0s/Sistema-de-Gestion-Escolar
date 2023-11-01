<?php
// Iniciar sesión si no está iniciada
session_start();

// Verificar si el usuario ha iniciado sesión, de lo contrario, redirigir a la página de inicio de sesión
if (!isset($_SESSION["estudiante_id"])) {
    header("Location: login.php");
    exit();
}

// Conectar a la base de datos (debes configurar tus propios datos de conexión)
$conn = new mysqli("localhost", "root", "", "users");

// Verificar la conexión a la base de datos
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el nombre de clase proporcionado en el formulario de búsqueda
if (isset($_POST["nombre_clase"])) {
    $nombre_clase = $_POST["nombre_clase"];

    // Consulta SQL para buscar clases por nombre
    $sql = "SELECT * FROM clases WHERE nombre LIKE ?";
    $stmt = $conn->prepare($sql);
    $nombre_clase = "%" . $nombre_clase . "%"; // Agregar comodines para búsqueda parcial
    $stmt->bind_param("s", $nombre_clase);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Búsqueda de Clases</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../resources/css/classroom.css">
</head>
<body>
<nav class="navbar">
      <div class="logo">
        <img src="../resources/img/logoo2.png" />
        <h2>Bright Horizon Academy</h2>
      </div>
      <div class="links">
      <a href="../view/vista_classroom.php">Inicio</a>
        <div class="dropdown">
          <a href="#"
            >Explore
            <img src="../resources/img/chevron.png" />
          </a>
          <div class="menu">
            <a href="../view/crear_clase.php"> Crea una clase! </a>
            
           
            
          </div>
        </div>
        <a href="../view/classroom.php" class="join-link"> Cerrar Sesión </a>
      </div>
    </nav>
<br><br><br><br><br><br><br>
    <div class="container">
        <h2>Resultado de Búsqueda de Clases</h2>

        <div class="clases-container">
            <?php
            if (isset($result)) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='clase-tarjeta'>";
                        echo "<h3>" . $row['nombre'] . "</h3>";
                        
                        // Verificar si el usuario ya se unió a esta clase
                        if (isset($_SESSION["clases_unidas"][$row['id']])) {
                            // Si ya se unió, muestra un enlace al índice de la clase
                            echo "<a href='index_clase.php?id=" . $row['id'] . "'>Ir al índice</a>";
                        } else {
                            // Si no se unió, muestra el formulario de ingreso de clave de acceso
                            echo "<form action='unirse_clase.php' method='post'>";
                            echo "<label for='clave_acceso'>Clave de Acceso:</label>";
                            echo "<input type='text' name='clave_acceso' required>";
                            echo "<input type='hidden' name='clase_id' value='" . $row['id'] . "'>";
                            echo "<input type='submit' value='Unirme'>";
                            echo "</form>";
                        }

                        // Mostrar el botón "Administrar Clase" si el usuario es el tutor de la clase
                        if ($_SESSION["estudiante_id"] == $row['tutor_id']) {
                            echo "<form action='administrar_clase.php' method='post'>";
                            echo "<label for='clave_admin'>Clave de Administrador:</label>";
                            echo "<input type='password' name='clave_admin' required>";
                            echo "<input type='hidden' name='clase_id' value='" . $row['id'] . "'>";
                            echo "<input type='submit' value='Administrar Clase'>";
                            echo "</form>";
                        }

                        echo "</div>";
                    }
                } else {
                    echo "<p>No se encontraron clases que coincidan con la búsqueda.</p>";
                }
            } else {
                echo "<p>No se realizó ninguna búsqueda.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
