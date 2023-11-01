<?php
include "conexion.php";

$estudianteId = $_GET["id"];
$query = $conn->real_escape_string($_GET["q"]);

$searchSql = "SELECT * FROM libros WHERE titulo LIKE '%$query%'";
$searchResult = $conn->query($searchSql);

if ($searchResult->num_rows > 0) {
    while ($row = $searchResult->fetch_assoc()) {
        // Genera el HTML para mostrar los resultados
        echo "<div class='libro-recuadro'>";
        echo "<h4>" . $row["titulo"] . "</h4>";
        echo "<p>ISBN: " . $row["isbn"] . "</p>";
        echo "<p>Cantidad Disponible: " . $row["cantidad_disponible"] . "</p>";
        echo "<img src='" . $row["foto_libro"] . "' width='100' height='150' alt=''>";
        // Agrega el botón Pedir o No Disponible según la disponibilidad
        if ($row["cantidad_disponible"] > 0) {
            // Agrega el formulario para pedir el libro (similar a tu código existente)
        } else {
            echo "<p>No Disponible</p>";
        }
        echo "</div>";
    }
} else {
    echo "<p>No se encontraron resultados.</p>";
}
?>