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

    <div class="col-11 d-flex flex-column justify-content-center aling-items-center">
        <h2 class="text-center">Consultas MySQL de moodle</h2>

        <div class="d-flex justify-content-center align-items-center col-12">

            <div class="list-group list-group-numbered col-9">
                <a href="consultas/consulta1.php" class="list-group-item">1.- Cuantos usuarios tiene registrados la plataforma</a>
                <a href="consultas/consulta2.php" class="list-group-item list-group-item-action">2.- Cuantos cursos estan creados en plataforma </a>
                <a href="#" class="list-group-item list-group-item-action">3.- Cuantos y cuales categorías existen</a>
                <a href="#" class="list-group-item list-group-item-action">4.- Cuantos alumnos hay en cada curso</a>
                <a href="#" class="list-group-item list-group-item-action">5.- Que tablas se afectan al subir un reurso de tipo archivo, a un topico de un curso</a>
                <a href="consultas/consulta6.php" class="list-group-item list-group-item-action">6.- En que tablas están los alumnos inscritos por curso (participantes)</a>
                <a href="consultas/consulta7.php" class="list-group-item list-group-item-action">7.- Lista de las tareas por un curso determinado</a>
                <a href="#" class="list-group-item list-group-item-action">8.- Listas las calificaciones de una tarea determinada por curso determinado</a>
                <a href="#" class="list-group-item list-group-item-action">9.- Lista de los examenes de un curso dado</a>
                <a href="consultas/consulta10.php" class="list-group-item list-group-item-action">10.- Lista las calificaciones de un examen en un curso determinado</a>
                <a href="consultas/consulta11.php" class="list-group-item list-group-item-action">11.- lista el promedio de calificaciones de un examen de un curso 
                    determinad</a>
            </div>

        </div>


    </div>

    
    
</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


</html>