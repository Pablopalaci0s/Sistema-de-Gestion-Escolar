

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión</title>
    <link rel="shortcut icon" href="../images/hat.png" type="image/x-icon">
    <link rel="stylesheet" href="../resources/css/normalize2.css">
    <link rel="stylesheet" href="../resources/css/estilos.css">

</head>
<body>
<header class="hero">
<nav class="nav container">
            <div class="nav__logo">
            <img class="nav__logo" src="../resources/img/logoo2.png" alt="">
                <h2 class="nav__title">Bright Horizons Academy
</h2>
            </div>

            <ul class="nav__link nav__link--menu">
                <li><span>
                    <a href="../view/cliente.php" class="nav__links">Inicio</a></span>
                </li>
                <li><span>
                    <a href="../view/calendario/usuarios/calendario.html" class="nav__links">Calendario</a></span>
                </li>
                <li><span>
                    <a href="contacto.html" class="nav__links">Contáctanos</a></span>
                </li>
                
                <li><span>
                    <a href="../controllers/login.php" class="nav__links">Biblioteca</a></span>
                </li>
                <li><span>
                    <a href="../view/ver_horarios.php" class="nav__links">Horarios</a></span>
                </li>
                <li><span>
                    <a href="../view/classroom.php" class="nav__links">Class</a></span>
                </li>
                <li><span>
                    <a href="../view/login.html" class="nav__links">Cerrar sesión</a></span>
                </li>

                <img src="../resources/img/close.svg" class="nav__close">
            </ul>

            <div class="nav__menu">
                <img src="../resources/img/menu.svg" class="nav__img">
            </div>
        </nav>

        <section class="hero__container container">
            <h1 class="hero__title">Bright Horizons Academy</h1>
            <p class="hero__paragraph">A través de nuestro sistema de gestión escolar, buscamos facilitar la comunicación entre estudiantes y personal docente. Nuestra plataforma en línea permite el acceso a información actualizada sobre horarios, calificaciones, tareas y eventos escolares. 
                Además, ofrecemos un canal de comunicación directa para resolver dudas o inquietudes de manera rápida y eficiente.</p>
            <a href="#" class="cta">Comienza ahora</a>
        </section>
    </header>

    <main>
        <section class="container about">
            <h2 class="subtitle">¿Qué encontrarás en este sitio web?</h2>
            <p class="about__paragraph">Este sitio web esta hecho facilitar tu experiencia académica y mantener una comunicación efectiva entre estudiantes, docentes y la institución educativa. Estamos comprometidos en brindarte las herramientas necesarias para que puedas aprovechar al máximo tu educación.</p>

            <div class="about__main">
                <article class="about__icons">
                    <img src="../resources/img/shapes.svg" class="about__icon">
                    <h3 class="about__title">Explorar recursos de la biblioteca</h3>
                    <p class="about__paragrah">Contamos con un sistema de gestión de biblioteca, podrás acceder a recursos en línea, realizar búsquedas de libros y verificar la disponibilidad de préstamos y devoluciones.</p>
                </article>

                <article class="about__icons">
                    <img src="../resources/img/paint.svg" class="about__icon">
                    <h3 class="about__title">Comunicarte con los docentes</h3>
                    <p class="about__paragrah">Nuestro sistema te brinda la posibilidad de comunicarte  con tus profesores a través de un formulario. Podrás realizar consultas, solicitar aclaraciones y obtener el apoyo necesario para tu desarrollo académico, que seran
                        respondidas directamente en tu e-mail!
                    </p>
                </article>

                <article class="about__icons">
                    <img src="../resources/img/code.svg" class="about__icon">
                    <h3 class="about__title">Mantenerte informado sobre eventos escolares</h3>
                    <p class="about__paragrah">A través de nuestro calendario escolar, podrás conocer los eventos y actividades importantes que tendrán lugar en nuestra institución, como exámenes, vacaciones, reuniones de padres y eventos especiales.</p>
                </article>
            </div>
        </section>

        <section class="knowledge">
            <div class="knowledge__container container">
                <div class="knowledege__texts">
                    <h2 class="subtitle">Acabamos de aperturar nuestra biblioteca virtual, accede ahora!</h2>
                    <p class="knowledge__paragraph"></p>
                    <a href="../controllers/login.php" class="cta">Entra a la biblioteca</a>
                </div>

                <div class="content-all">
        <div class="content-carrousel">
            <figure><img src="../resources/img/libro1.jpg"></figure>
            <figure><img src="../resources/img/libro2.jpg"></figure>
            <figure><img src="../resources/img/libro3.jpg"></figure>
            <figure><img src="../resources/img/libro4.webp"></figure>
            <figure><img src="../resources/img/libro5.jpg"></figure>
            <figure><img src="../resources/img/libro6.webp"></figure>
            <figure><img src="../resources/img/libro7.jpg"></figure>
            <figure><img src="../resources/img/libro8.png"></figure>
            <figure><img src="../resources/img/libro9.jpg"></figure>
            
        </div>
            </div>
        </section>


        <section class="testimony">
            <div class="testimony__container container">
                <img src="../resources/img/leftarrow.svg" class="testimony__arrow" id="before">

                <section class="testimony__body testimony__body--show" data-id="1">
                    <div class="testimony__texts">
                        <h2 class="subtitle">Mi nombre es Pablo Palacios, <span class="testimony__course">Director académico</span></h2>
                        <p class="testimony__review">
                        Dirijo la administración escolar, el consejo de profesores y la organización escolar. 
                        </p>
                    </div>

                    <figure class="testimony__picture">
                        <img src="../resources/img/1.jpeg" class="testimony__img">
                    </figure>
                </section>




                
                <section class="testimony__body" data-id="2">
                    <div class="testimony__texts">
                        <h2 class="subtitle">Mi nombre es Claudia Yanira, <span class="testimony__course">jefa de estudios</span></h2>
                        <p class="testimony__review">Gestiono las tareas académicasy de controlar la actividad y disciplina del alumnado, así como el correcto ejercicio profesional del personal docente y del personal laboral.</p>
                    </div>

                    <figure class="testimony__picture">
                        <img src="../resources/img/1.jpeg" class="testimony__img">
                    </figure>
                </section>

                <section class="testimony__body" data-id="3">
                    <div class="testimony__texts">
                        <h2 class="subtitle">Mi nombre es Eduardo López, <span class="testimony__course">Subdirector</span></h2>
                        <p class="testimony__review">Coordino los diferentes programas del centro educativo que le delega el Director y velo por su correcta ejecución</p>
                    </div>

                    <figure class="testimony__picture">
                        <img src="../resources/img/1.jpeg" class="testimony__img">
                    </figure>
                </section>

                <section class="testimony__body" data-id="4">
                    <div class="testimony__texts">
                        <h2 class="subtitle">Mi nombre es Raúl Sorto, <span class="testimony__course">Coordinador de educación infantil</span></h2>
                        <p class="testimony__review">Organizo los servicios, las actividades y los eventos de infantil en horario extraescolar y durante las vacaciones escolares.</p>
                    </div>

                    <figure class="testimony__picture">
                        <img src="../resources/img/1.jpeg" class="testimony__img">
                    </figure>
                </section>

                <section class="testimony__body" data-id="5">
                 <div class="testimony__texts">
                    <h2 class="subtitle">Mi nombre es Oscar Adriano, <span class="testimony__course">Coordinador de educación primaria</span></h2>
               <p class="testimony__review">Dirijo y doy seguimiento a las actividades de aprendizaje de los estudiantes de primaria.</p>
                 </div>

               <figure class="testimony__picture">
               <img src="../resources/img/1.jpeg" class="testimony__img">
              </figure>
               </section>


                
                


                <img src="../resources/img/rightarrow.svg" class="testimony__arrow" id="next">
            </div>
        </section>

        <section class="questions container">
            <h2 class="subtitle">Preguntas frecuentes</h2>
            <p class="questions__paragraph">Conoce las preguntas mas hechas por los estudiantes.</p>

            <section class="questions__container">
                <article class="questions__padding">
                    <div class="questions__answer">
                        <h3 class="questions__title">¿Cómo es el funcionamiento del horario de clases del colegio en el sistema?
                            <span class="questions__arrow">
                                <img src="../resources/img/arrow.svg" class="questions__img">
                            </span>
                        </h3>


                        <p class="questions__show">En nuestro sistema puedes acceder al apartado de horario a través de la barra de navegación, donde pondrás encontrar 
                            los diversos eventos que están disponibles en nuestra institución, como entrevistas a autores de obras reconocidas, como eventos deportivos y proximas evaluaciones.
                        </p>
                    </div>
                </article>

                <article class="questions__padding">
                    <div class="questions__answer">
                        <h3 class="questions__title">¿Dónde puedo encontrar información sobre eventos escolares, excursiones y actividades extracurriculares?
                            <span class="questions__arrow">
                                <img src="../resources/img/arrow.svg" class="questions__img">
                            </span>
                        </h3>

                        <p class="questions__show">En el sistema de gestión escolar, busca la sección de calendario o eventos. Allí encontrarás información sobre eventos escolares, excursiones, actividades extracurriculares y fechas importantes. Mantente al tanto de las actualizaciones y anuncios en esta sección para estar informado sobre las actividades escolares.</p>
                    </div>
                </article>

                <article class="questions__padding">
                    <div class="questions__answer">
                        <h3 class="questions__title">¿Qué puedo hacer al acceder a la biblioteca virtual?
                            <span class="questions__arrow">
                                <img src="../resources/img/arrow.svg" class="questions__img">
                            </span>
                        </h3>

                        <p class="questions__show">Podrás acceder a la bibliteca virtual con el codigo de acceso y contraseña que te dará el administrador de la institución
                            ahi podrás acceder a diversos libros, novelas y variedad de cosas para que puedas leer y disfrutarlo al máximo, pero recuerda que tienes que devolver los libros!
                        </p>
                    </div>
                </article>
            </section>

            <section class="questions__offer">
                <h2 class="subtitle"></h2>
                <p class="questions__copy"></p>
                <a href="cliente.php" class="cta">Regresa al nicio
                </a>
            </section>
        </section>
    </main>

   
    <footer class="footer">
        <section class="footer__container container">
        <ul class="nav__link nav__link--menu">
                <li><span>
                    <a href="../view/cliente.php" class="nav__links">Inicio</a></span>
                </li>
                <li><span>
                    <a href="../view/calendariouser.html" class="nav__links">Calendario</a></span>
                </li>
                <li><span>
                    <a href="contacto.html" class="nav__links">Contáctanos</a></span>
                </li>
                
                <li><span>
                    <a href="../controllers/login.php" class="nav__links">Biblioteca</a></span>
                </li>
                <li><span>
                    <a href="../view/ver_horarios.php" class="nav__links">Horarios</a></span>
                </li>
                <li><span>
                    <a href="../view/classroom.php" class="nav__links">Class</a></span>
                </li>
                <li><span>
                    <a href="../view/login.html" class="nav__links">Cerrar sesión</a></span>
                </li>

                <img src="../resources/img/close.svg" class="nav__close">
            </ul>
    </nav>
        </section>

        <section class="footer__copy container">
            <div class="footer__social">
                <a href="#" class="footer__icons"><img src="../resources/img/facebook.svg" class="footer__img"></a>
                <a href="#" class="footer__icons"><img src="../resources/img/twitter.svg" class="footer__img"></a>
                <a href="#" class="footer__icons"><img src="../resources/img/youtube.svg" class="footer__img"></a>
            </div>

            <h3 class="footer__copyright">Derechos reservados &copy; Bright Horizons Academy</h3>
        </section>
    </footer>

    <script src="../resources/js/slider.js"></script>
    <script src="../resources/js/questions.js"></script>
    <script src="../resources/js/menu.js"></script>
</body>
</html>