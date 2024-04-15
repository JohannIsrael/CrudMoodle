<?php
include '../conexion.php';

function get_TotalAlumnosXCurso(){
    global $conn;
    $query = 
    "
    SELECT fullname as Curso,count(*) as Cantidad FROM mdl_enrol 
    INNER JOIN mdl_user_enrolments ON mdl_enrol.id = mdl_user_enrolments.enrolid 
    INNER JOIN mdl_course ON mdl_enrol.courseid = mdl_course.id GROUP BY courseid;
    ";
    $statement = $conn->prepare($query);
    $statement->execute();

    $resultSet = $statement->get_result();
    $alumnosxcurso = $resultSet->fetch_all(MYSQLI_ASSOC);

    return $alumnosxcurso;
}

// Alumnos por curso
$cursos = get_TotalAlumnosXCurso();


?>


<!DOCTYPE html>
<html>
<head>
    <title>Lista de Categorias</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
</head>
<body>
<a href="../index.php" class="my-4 text-center"><h4>Regresar al menu</h4></a>
    <div class="container">
        <h2 class="pt-4">Cantidad de participantes por curso</h2>

        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cursos as $curso) : ?>
                    <tr>
                        <td><?= $curso['Curso']; ?></td>
                        <td><?= $curso['Cantidad']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
