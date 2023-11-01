<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="../../../resources/img/hat.png" type="image/x-icon">
    <link rel="stylesheet" href="../../../resources/css/normalize.css">
    <link rel="stylesheet" href="../../../resources/css/estilosNotas.css">
    <link rel="stylesheet" href="../../../resources/css/notas.css">
</head>

<body>
    <header class="hero">
        <nav class="nav container">
            <div class="nav__logo">
                <h2 class="nav__title">Bright Horizons Academy.</h2>
            </div>

            <ul class="nav__link nav__link--menu">

                <li class="nav__items">
                    <a href="../admin.php" class="nav__links">Inicio</a>
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


    <?php
    require_once '../db/db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $id = $_GET['id'];

        if ($con->connect_error) {
            die("Error de conexión a la base de datos: " . $con->connect_error);
        }

        $query = "SELECT score.id, score.score, score.date_register, sb.id AS subject_id, sb.nombre AS subject_name, estudiantes.nombre as student_name, grado.nombre as grade_name, section.name as section_name
              FROM score 
              INNER JOIN asignaturas AS sb ON score.id_subject = sb.id
              INNER JOIN estudiantes ON score.student_id = estudiantes.id
              INNER JOIN grado ON estudiantes.id_grade = grado.id
              INNER JOIN section ON estudiantes.id_section = section.id
              WHERE score.id = $id";

        $result = $con->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <div class="conteiner4">
                <h2>Estudiante: <?php echo $row['student_name']; ?></h2> <!-- Título con el nombre del estudiante -->
                <br>
                <h2>Grado: <?php echo $row['grade_name']; ?></h2> <!-- Título con el grado -->
                <h2>Sección: <?php echo $row['section_name']; ?></h2> <!-- Título con la sección -->
                <form action="guardar_edicion.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <label for="score">Nota:</label>
                    <input type="text" name="score" value="<?php echo $row['score']; ?>"><br>

                    <label for="subject">Materia:</label>
                    <select name="subject">
                        <?php
                        $querySubjects = "SELECT id, nombre FROM asignaturas";
                        $resultSubjects = $con->query($querySubjects);

                        if ($resultSubjects && $resultSubjects->num_rows > 0) {
                            while ($subjectRow = $resultSubjects->fetch_assoc()) {
                                $selected = ($subjectRow['id'] == $row['subject_id']) ? 'selected' : '';
                                echo "<option value='{$subjectRow['id']}' $selected>{$subjectRow['nombre']}</option>";
                            }
                        }
                        ?>
                    </select>
                    <br>

                    <input type="submit" value="Guardar Cambios">
                </form>

                <br><button onclick='goBack()'>Regresar</button>
                <!-- Para boton regresar -->
            </div>

            <script>
                function goBack() {
                    window.history.back();
                }
            </script>
            <footer class="footer">

                <section class="footer__copy container">
                    <h3 class="footer__copyright">Derechos reservados &copy; Sistema de gestión escolar</h3>
                </section>
            </footer>

        </body>

        </html>

        <?php
        } else {
            echo "Registro no encontrado.";
        }

        $con->close();
    } else {
        echo "ID de registro no especificado.";
    }
    ?>