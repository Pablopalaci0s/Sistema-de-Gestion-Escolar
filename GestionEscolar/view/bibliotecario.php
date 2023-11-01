<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../resources/css/normalize.css">
    <link rel="stylesheet" href="../resources/css/biblioteca.css">


    <link rel="stylesheet" href="../resources/css/style.css">
    <link rel="stylesheet" href="../resources/css/em2.css">
    <link rel="stylesheet" href="../resources/css/style2.css">
 

</head>
<body>
<header class="hero">
        <nav class="nav container">
            <div class="nav__logo">
                <h2 class="nav__title">Bright Horizons Academy.</h2>
            </div>

            <ul class="nav__link nav__link--menu">












 
<li class="nav__items">
<a href="../view/login.html" class="nav__links">Cerrar sesión</a>
</li>



<img src="../images/close.svg" class="nav__close">
</ul>

            <div class="nav__menu">
                <img src="../images/menu.svg" class="nav__img">
            </div>
        </nav>


        <section class="hero__container container">
            <h1 class="hero__title">Bright Horizons Academy</h1>
            <p class="hero__title">gestión de biblioteca</p>
            <a href="#" class="cta"> desliza</a>
        </section>
    </header>
    <?php
include "../models/conexion.php";

$sql = "SELECT * FROM libros";
$result = $conn->query($sql);
?>
    <br>
    <a href="../controllers/agregar_libro.php" class="add-link">Agregar Libro</a>
    <?php if ($result->num_rows > 0) : ?>
    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>ISBN</th>
                <th>Cantidad Disponible</th>
                <th>Foto del Libro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["titulo"] . "</td>";
                echo "<td>" . $row["isbn"] . "</td>";
                echo "<td>" . $row["cantidad_disponible"] . "</td>";
                echo "<td><img src='" . $row["foto_libro"] . "' alt='Portada'></td>";
                echo "<td><a href='../controllers/editar_libro.php?id=" . $row["id"] . "'>Editar</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <?php else : ?>
    <div class="no-records">
        No hay libros registrados.
    </div>
    <?php endif; ?>
</section>

<!-- ... (tu código HTML del pie de página) ... -->
</body>

  
    <script src="../resources/js/slider.js"></script>
    <script src="../resoures/js/questions.js"></script>
    <script src="../resources/js/menu.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../resources/js/des.js"></script>
  
</html>


