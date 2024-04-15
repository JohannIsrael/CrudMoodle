<?php
include '../conexion.php';

function getCursos(){
    global $conn;
    $query = 
    "
    SELECT id, fullname FROM mdl_course;
    ";
    $statement = $conn->prepare($query);
    $statement->execute();

    $resultSet = $statement->get_result();
    $tareas = $resultSet->fetch_all(MYSQLI_ASSOC);

    return $tareas;
}

function getExamenesxCursos($cursoID){
    global $conn;
    $query = 
    "
    SELECT quizz.name AS exam_name FROM mdl_quiz quizz 
    JOIN mdl_course curso ON curso.id = quizz.course WHERE curso.id = $cursoID;
    ";
    $statement = $conn->prepare($query);
    $statement->execute();

    $resultSet = $statement->get_result();
    $alumnosxcurso = $resultSet->fetch_all(MYSQLI_ASSOC);

    return $alumnosxcurso;
}

// Alumnos por curso
$value = NULL;
$calificaciones = NULL;

if (isset($_POST['curso'])) {
    $value = $_POST['curso'];
    $calificaciones = getExamenesxCursos($value);
}

$cursos = getCursos($value);

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
                <label for="cursos" class="form-label">Selecciona una tarea</label>
                <select class="form-select" id="cursos" name="curso">
                    <?php foreach ($cursos as $curso) : ?>
                        <option value="<?php echo $curso['id']; ?>"><?php echo htmlspecialchars($curso['fullname']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th>exam_name</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
                <?php foreach ($calificaciones as $calificacion) : ?>
                    <tr>
                        <td><?= $calificacion['exam_name']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (!$calificaciones && $_SERVER['REQUEST_METHOD'] === 'POST') : ?>
                <h2>Aun no hay resgistros</h2>
            <?php endif; ?>

            </tbody>
        </table>
    </div>
</body>
</html>
