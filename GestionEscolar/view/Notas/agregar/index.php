<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Notas</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="../../../resources/img/hat.png" type="image/x-icon">
    <link rel="stylesheet" href="../../../resources/css/normalize.css">
    <link rel="stylesheet" href="../../../resources/css/estilosNotas.css">
    <link rel="stylesheet" href="../../../resources/css/notas.css">

</head>

<header class="hero">
        <nav class="nav container">
            <div class="nav__logo">
                <h2 class="nav__title">Bright Horizons Academy.</h2>
            </div>

            <ul class="nav__link nav__link--menu">

                <li class="nav__items">
                    <a href="../admin.php" class="nav__links">Inicio</a>
                </li>

                <li class="option">
                    <a><button class="nav__dropdown-toggle">Profesores</button></a>
                    <div class="lista">
                        <p class="element"> <a href="../view/secambioname.php" class="choice">G profesores</a></p>
                        <p class="element"> <a href="../controllers/agregar_horario.php" class="choice">Asistencias
                                P</a></p>
                    </div>
                </li>

                <li class="option">
                    <a><button class="nav__dropdown-toggle2">Estudiantes</button></a>
                    <div class="lista2">
                        <p class="element"> <a href="../controllers/adestudiantes.php" class="choice">G estudiantes</a>
                        </p>
                        <p class="element"> <a href="../view/calendario.html" class="choice">G calendario</a></p>
                        <p class="element"> <a href="../controllers/agregar_calificacion.php"
                                class="choice">Calificaciones</a></p>
                    </div>
                </li>

                <li class="option">
                    <a><button class="nav__dropdown-toggle3">Otros</button></a>
                    <div class="lista3">
                        <p class="element"> <a href="../view/admin_libros.php" class="choice">Biblioteca </a> </p>
                        <p class="element"> <a href="../view/registro.html" class="choice">Usuarios</a></p>
                    </div>
                </li>



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
            <h1 class="hero__title">Sistema de gestión escolar</h1>
            <p class="hero__title">Gestión de notas</p>
        </section>
    </header>


<body>
    <div id="centrado">
        <div id="mensaje"></div>
    </div>
    <div id="centrado">
        <form action="guardar_notas.php" method="post" id="formulario_notas">
            <div class="containerr  col-md-4 ">
                <div class="form-group py-2">

                    <label for="grade"> Grado</label>
                    <select class="form-select" id="grade">
                        <option value=""> Select grado</option>
                        <?php
                        require_once '../db/db.php';
                        $query = "select * from grado";
                        // $query = mysqli_query($con, $qr);
                        $result = $con->query($query);
                        if ($result->num_rows > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {

                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                                <?php
                            }
                        }

                        ?>

                    </select>
                </div>
                <div class="form-group py-2">
                    <div class="form-group py-2">

                        <label for="grade"> seccion</label>
                        <select class="form-select" id="seccion">
                            <option value=""> Select seccion</option>
                            <?php

                            $query = "select * from section";

                            $result = $con->query($query);
                            if ($result->num_rows > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {

                                    ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php
                                }
                            }
                            ?>

                        </select>
                    </div>
                    <!-- asignatura -->
                    <div class="form-group py-2 ">
                        <label for="subject">Asignatura</label>
                        <select class="form-select" id="asignatura" name="asignatura">
                            <option value="">Select asignatura</option>
                            <?php
                            $query = "SELECT * FROM asignaturas";
                            $result = $con->query($query);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group py-2 ">
                        <label for="grade"> Student</label>
                        <select class="form-select" id="student" name="student">
                            <option value="">Select student</option>
                        </select>
                    </div>
                    <div class="form-group py-2">
                        <label for="score">Puntuación</label>
                        <input type="text" id="score" name="score">
                    </div>
                    <input type="submit" value="Registrar notas" id="Registrar_notas">
                </div>
        </form>
        <div id="centrado-enlace">
            <a href="../index.html" id="Ir_Mostrar">Ir a la página de mostrar notas</a>
        </div>
    </div>

    <script src="AJAX.js"></script>
</body>

</html>