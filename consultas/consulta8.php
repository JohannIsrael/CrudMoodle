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

function get_CalfTareas($tarea){
    global $conn;
    $query = 
    "
    SELECT mdl_user.firstname, mdl_assign_grades.grade FROM mdl_assign_grades
    INNER JOIN mdl_assign ON mdl_assign_grades.assignment=mdl_assign.id 
    INNER JOIN mdl_user ON mdl_assign_grades.userid=mdl_user.id
    WHERE mdl_assign.name='$tarea';
    ";
    $statement = $conn->prepare($query);
    $statement->execute();

    $resultSet = $statement->get_result();
    $alumnosxcurso = $resultSet->fetch_all(MYSQLI_ASSOC);

    return $alumnosxcurso;
}

// Alumnos por curso
$value = NULL;

if (isset($_POST['tarea'])) {
    $value = $_POST['tarea'];
    $calificaciones = get_CalfTareas($value);
}

$tareas = getTareas($value);

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
