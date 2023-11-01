<!DOCTYPE html>
<html>
<head>
<title>Inicio de Sesión - Estudiantes</title>
    <link rel="stylesheet" href="../resources/css/login_biblio.css">

</head>
<body>
    <div class="container">
        <img class="logo" src="../resources/img/R.png" alt="Logo">
        <h1>Inicio de Sesión - Aula Virtual</h1>
        <form action="../view/login_aula.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required>

            <label for="numero_identificacion">Número de Identificación:</label>
            <input type="password" name="numero_identificacion" required>

            <input type="submit" value="Iniciar Sesión">
           

        </form>

        <br>
        <a href="../view/cliente.php" class="btn">Ir a la Página Principal</a>

    </div>
</body>
</html>