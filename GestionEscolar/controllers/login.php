<!DOCTYPE html>
<html>
<head>
<title>Inicio de Sesión - Estudiantes</title>
    <link rel="stylesheet" href="../resources/css/login_biblio.css">

</head>
<body>
    <div class="container">
        <img class="logo" src="../resources/img/hat.png" alt="Logo">
        <h1>Inicio de Sesión - Biblioteca</h1>
        <form action="login_estudiante.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required>

            <label for="numero_identificacion">Número de Identificación:</label>
            <input type="password" name="numero_identificacion" required>

            <input type="submit" value="Iniciar Sesión">
           

        </form>

        <br>
        <a href="../view/cliente.php" class="btn">Ir a la Página Principal</a>
        <script src="../resources/js/hidden.js"></script>
    </div>
</body>
</html>