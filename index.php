<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body class="d-flex flex-column justify-content-center align-items-center py-4">
    <?php include 'conexion.php'; ?>

    <div class="col-11 d-flex flex-column justify-content-center aling-items-center py-4">
        <h2 class="text-center">Consultas MySQL de moodle</h2>

        <div class="d-flex flex-wrap justify-content-center align-items-center col-12">

            <div class="list-group list-group-numbered col-9 mt-4">
                <h4 class="text-center fw-bold py-2">Ejercicios 16</h4>
                <a href="consultas/consulta1.php" class="list-group-item">1.- Cuantos usuarios tiene registrados la plataforma</a>
                <a href="consultas/consulta2.php" class="list-group-item list-group-item-action">2.- Cuantos cursos estan creados en plataforma </a>
                <a href="consultas/consulta3.php" class="list-group-item list-group-item-action">3.- Cuantos y cuales categorías existen</a>
                <a href="consultas/consulta4.php" class="list-group-item list-group-item-action">4.- Cuantos alumnos hay en cada curso</a>
                <a href="consultas/consulta5.php" class="list-group-item list-group-item-action">5.- Que tablas se afectan al subir un reurso de tipo archivo, a un topico de un curso</a>
                <a href="consultas/consulta6.php" class="list-group-item list-group-item-action">6.- En que tablas están los alumnos inscritos por curso (participantes)</a>
                <a href="consultas/consulta7.php" class="list-group-item list-group-item-action">7.- Lista de las tareas por un curso determinado</a>
                <a href="consultas/consulta8.php" class="list-group-item list-group-item-action">8.- Listas las calificaciones de una tarea determinada por curso determinado</a>
                <a href="consultas/consulta9.php" class="list-group-item list-group-item-action">9.- Lista de los examenes de un curso dado</a>
                <a href="consultas/consulta10.php" class="list-group-item list-group-item-action">10.- Lista las calificaciones de un examen en un curso determinado</a>
                <a href="consultas/consulta11.php" class="list-group-item list-group-item-action">11.- lista el promedio de calificaciones de un examen de un curso determinad</a>
            </div>

            <div class="list-group list-group-numbered col-9 mt-4">
                <h4 class="text-center fw-bold py-2">Ejercicios 17</h4>
                <a href="consultas17/consulta1.php" class="list-group-item">1.- Tener como entrada el género y contar cuántos hay de cada uno.</a>
                <a href="consultas17/consulta2.php" class="list-group-item">2.- Cuántos hombres foráneos hay.</a>
                <a href="consultas17/consulta3.php" class="list-group-item">3.- Cuántas mujeres foráneas hay.</a>
                <a href="consultas17/consulta4.php" class="list-group-item">4.- Cuántos no binarios y no foráneos hay.</a>

                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" >
                                5. Generacion de Reportes
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body p-0" >
                                <a href="consultas17/consulta5.php" class="ps-5 list-group-item list-group-item-action">
                                    5-1.- Un reporte que incluya: nombre, apellidos, número de control, género, foráneos.

                                </a>
                                <a href="consultas17/consulta5-2.php" class="ps-5 list-group-item list-group-item-action">
                                    5-1.- Un reporte que incluya: nombre, apellidos, número de control, género, foráneos, Filtrado por cursos

                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>

            <div class="list-group list-group-numbered col-9 mt-4">
                <h4 class="text-center fw-bold py-2">Ejercicios 18</h4>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" >
                                1. Realiza la consulta SQL necesaria para obtener un listado con la siguiente estructura
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body p-0" >
                                <a href="consultas18/consulta1.php" class="ps-5 list-group-item list-group-item-action">
                                    1.- Categoría, nombre del curso, profesor, fecha inicio, fecha finalización, número de participantes
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="consultas18/consulta2.php" class="list-group-item list-group-item-action">2.- Realiza la consulta SQL necesaria para obtener un listado de todos los cursos por categoría </a>
                <a href="consultas18/consulta3.php" class="list-group-item list-group-item-action">3.- Realiza la consulta SQL necesaria para obtener un listado de todos los cursos por profesor, si es necesario, ajusta en la sección de Participantes, para que coincida que el mismo profesor pueda dar dos cursos. </a>
                <a href="consultas18/consulta4.php" class="list-group-item list-group-item-action">4.- Realiza la consulta SQL necesaria para obtener un listado de cursos por mes.</a>
                <div class="accordion" id="accordionExample2">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne2" aria-expanded="true" aria-controls="collapseOne" >
                                5. Realiza la consulta SQL necesaria para obtener
                            </button>
                        </h2>
                        <div id="collapseOne2" class="accordion-collapse collapse" data-bs-parent="#accordionExample2">
                            <div class="accordion-body p-0" >
                                <a href="consultas18/consulta5.php" class="ps-5 list-group-item list-group-item-action">
                                <span class="d-block">1. ¿cuántos hombres participaron en curso en determinado mes?</span>
                                <span class="d-block">2. ¿cuántas mujeres participaron en curso en determinado mes?</span>
                                <span class="d-block">3. ¿cuántos no binarios participaran en curso en determinado mes?</span>
                                <span class="d-block">4. ¿cuántos cursos se impartieron por mes?</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>


    </div>

    
    <style>
    @keyframes fade-out {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
            visibility: hidden;
        }
    }

    .fade-out-animation {
        animation: fade-out 0.5s ease forwards;
    }

    .accordion-collapse.fade-out-animation{
        opacity: 1;
    }

    
    </style>

</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="js/acordion.js"></script>

</html>