<?php
session_start();
include "../models/conexion.php"; 

// Verificar si el usuario ha iniciado sesión, de lo contrario, redirigir a la página de inicio de sesión
if (!isset($_SESSION["estudiante_id"])) {
    header("Location: login.php");
    exit();
}

// Función para obtener el nombre del usuario desde la base de datos
function obtenerNombreUsuario($conn, $estudiante_id) {
    // Consultar la base de datos para obtener el nombre del usuario
    $sql = "SELECT nombre FROM estudiantes_login WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $estudiante_id);
    $stmt->execute();
    $stmt->fetch();
    $stmt->close();

}

// Conectar a la base de datos (debes configurar tus propios datos de conexión)
$conn = new mysqli("localhost", "root", "", "users");

// Verificar la conexión a la base de datos
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}


// Consulta SQL para obtener las clases
$sqlClases = "SELECT * FROM clases";

// Ejecutar la consulta de las clases
$resultClases = $conn->query($sqlClases);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Aula Virtual</title>
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
    <br>
    <br>
    <br><br><br>
    <div class="container">
        <!-- Botones para unirse o crear una clase -->
      
        <h2>Buscar Clases</h2>
<form action="procesar_busqueda_clase.php" method="post">
    <label for="nombre_clase">Nombre de la Clase:</label>
    <input type="text" name="nombre_clase" id="nombre_clase">
    <input type="submit" value="Buscar">
</form>

      

    
    <!-- Mostrar la lista de clases -->
    <h2>Clases Disponibles</h2>
    <div class="clases-container">
        <?php
        // Comprobar si hay clases disponibles
        if ($resultClases->num_rows > 0) {
            while ($row = $resultClases->fetch_assoc()) {
                echo "<div class='clase-tarjeta'>";
                echo "<h3>" . $row['nombre'] . "</h3>";

                // Verificar si el usuario ya se unió a esta clase
                if (isset($_SESSION["clases_unidas"][$row['id']])) {
                    // Si ya se unió, muestra un enlace al índice de la clase
                    echo "<a href='index_clase.php?id=" . $row['id'] . "'>Ir al índice</a>";
                } else {
                    // Muestra el formulario de ingreso de clave de acceso (dentro del bucle)
                    echo "<form action='procesar_administracion.php?id=" . $row['id'] . "' method='post'>";
                    echo "<label for='clave_admin'>Clave de Administrador:</label>";
                    echo "<input type='password' name='clave_admin' required>";
                    echo "<input type='submit' value='Administrar Clase'>";
                    echo "</form>";

                    // Agregar botón para unirse a la clase
                    echo "<form action='unirse_clase.php?id=" . $row['id'] . "' method='post'>";
                    echo "<label for='codigo_acceso'>Código de Acceso:</label>";
                    echo "<input type='text' name='codigo_acceso' required>";
                    echo "<input type='submit' value='Unirse a la Clase'>";
                    echo "</form>";
                }

                echo "</div>";
            }
        } else {
            echo "<p>No se encontraron clases disponibles.</p>";
        }
        ?>  
    </div>
</div>
    
    <!-- Ventana emergente para buscar clases -->
    <div id="formularioBusqueda" class="modal">
        <div class="modal-content">
            <span class="cerrar" onclick="cerrarFormularioBusqueda()">&times;</span>
            <h2>Buscar Clases Disponibles</h2>
            <form action="procesar_busqueda_clase.php" method="post">
                <label for="nombre_clase">Nombre de la Clase:</label>
                <input type="text" name="nombre_clase" id="nombre_clase">
                <input type="submit" value="Buscar">
            </form>
        </div>
    </div>
    
    <script>
        function mostrarFormularioBusqueda() {
            var modal = document.getElementById("formularioBusqueda");
            modal.style.display = "block";
        }
        
        function cerrarFormularioBusqueda() {
            var modal = document.getElementById("formularioBusqueda");
            modal.style.display = "none";
        }
    </script>
</body>
</html>
