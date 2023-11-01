$(document).ready(function () {
    // variables
    var gradeid = "";
    var seccionid = "";
    var subjectid = "";

    // Dato de la nota
    var studentid = "";

    // Captura de ID

    $("#grade").on('change', function () {
        gradeid = $("#grade").val();
        CambioMenu();
    });

    $("#seccion").on('change', function () {
        seccionid = $("#seccion").val();
        CambioMenu();
    });

    $("#asignatura").on('change', function () {
        subjectid = $("#asignatura").val();
        CambioMenu();
    });

    //Cambio de los elementos
    $("#student").on('change', function () {
        studentid = $("#student").val();
        // Para pruebas vconsole.log("El valor seleccionado en 'student' cambió a: " + studentid);
    });


    // Funcion estudiantes desplegables
    function CambioMenu() {
        if (gradeid !== "" && seccionid !== "") {
            $.ajax({
                method: "POST",
                url: "response.php",
                data: {
                    id: gradeid,
                    sid: seccionid
                },
                dataType: "html",
                success: function (data) {
                    $("#student").html(data);
                }
            });
        }
    }


    // Envio de formulario
    $("#formulario_notas").on('submit', function (e) {
        e.preventDefault();

        // Obtener valores de ID de estudiante, nota
        var studentid = $("#student").val();
        var score = $("#score").val();

        //  Evitar notas negativas o mayores
        if (score < 0 || score > 10) {
            alert("Por favor coloca correctamente el dato, nota no mayor a 10 y no menor a 0");
        } else {

            // Envia los datos solo si se ha seleccionado estudiante y si hay nota

            if (studentid !== "" && score !== "") {
                $.ajax({
                    method: "POST",
                    url: "guardar_notas.php",
                    data: {
                        student: studentid,
                        score: score,
                        subjectid: subjectid
                    },
                    success: function (data) {
                        // Muestra mensaje en caso de ser exitoso
                        $("#mensaje").html(data).fadeIn().addClass("fade");

                        // Reincia los valores
                        $("#grade").val("");
                        $("#seccion").val("");
                        $("#student").val("");
                        $("#score").val("");
                        $("#asignatura").val("");

                        // Oculta el mensaje después de 5 segundos
                        setTimeout(function () {
                            $("#mensaje").fadeOut();
                        }, 5000); // 5000 milisegundos = 5 segundos
                    }
                });
            } else {
                alert("Por favor, seleccione un estudiante y una puntuación.");
            }
        }
    });
});
