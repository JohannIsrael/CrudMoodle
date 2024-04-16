<?php
include '../conexion.php';

function getTareas(){
    global $conn;
    $query = 
    "
    SELECT name FROM mdl_assign;
    ";
    $statement = $conn->prepare($query);
    $statement->execute();

    $resultSet = $statement->get_result();
    $tareas = $resultSet->fetch_all(MYSQLI_ASSOC);

    return $tareas;
}

function getCurses(){
    global $conn;
    $query = 
    "
    SELECT id, fullname FROM mdl_course;
    ";
    $statement = $conn->prepare($query);
    $statement->execute();

    $resultSet = $statement->get_result();
    $cursos = $resultSet->fetch_all(MYSQLI_ASSOC);

    return $cursos;
}

function get_CalfTareas($tarea, $curso){
    global $conn;
    $query = 
    "
    SELECT mdl_user.firstname, mdl_assign_grades.grade FROM mdl_assign_grades
    INNER JOIN mdl_assign ON mdl_assign_grades.assignment=mdl_assign.id 
    INNER JOIN mdl_user ON mdl_assign_grades.userid=mdl_user.id
    INNER JOIN mdl_course ON mdl_assign.course=mdl_course.id
    WHERE mdl_assign.name='$tarea' AND mdl_course.fullname='$curso';
    ";
    $statement = $conn->prepare($query);
    $statement->execute();

    $resultSet = $statement->get_result();
    $alumnosxcurso = $resultSet->fetch_all(MYSQLI_ASSOC);

    return $alumnosxcurso;
}


// Alumnos por curso
$value = NULL;
$value2 = NULL;

if (isset($_POST['tarea']) && isset($_POST['curso'])) {
    $value = $_POST['tarea'];
    $value2 = $_POST['curso'];
    $calificaciones = get_CalfTareas($value, $value2);
}

$tareas = getTareas($value);
$cursos = getCurses($value2)

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
        <h2 class="pt-4">Lista las calificaciones de una tarea determinada</h2>
        <form action="" method="post">
    <div class="mb-3">
        <label for="cursos" class="form-label">Seleccione un curso</label>
        <select class="form-select" id="cursos" name="curso">
            <option value="">-- Selecciona una opción --</option> 
            <?php foreach ($cursos as $curso) : ?>
                <option value="<?php echo $curso['fullname']; ?>"><?php echo htmlspecialchars($curso['fullname']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="tareas" class="form-label">Selecciona una tarea</label>
        <select class="form-select" id="tareas" name="tarea">
            <option value="">-- Selecciona una opción --</option> 
            <?php foreach ($tareas as $tarea) : ?>
                <option value="<?php echo $tarea['name']; ?>"><?php echo htmlspecialchars($tarea['name']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>


        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
                <?php foreach ($calificaciones as $calificacion) : ?>
                    <tr>
                        <td><?= $calificacion['firstname']; ?></td>
                        <td><?= $calificacion['grade']; ?></td>
                    </tr>
                <?php endforeach; ?>
             <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
