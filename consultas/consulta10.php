<?php
include '../conexion.php';

// Obtener todos los cursos para el select
$sqlCursos = 'SELECT id, fullname FROM mdl_course';
$stmtCursos = $conn->prepare($sqlCursos);
$stmtCursos->execute();
$cursos = $stmtCursos->get_result()->fetch_all(MYSQLI_ASSOC);

// Obtener todos los quizzes para el select
$sqlQuizzes = 'SELECT id, name FROM mdl_quiz';
$stmtQuizzes = $conn->prepare($sqlQuizzes);
$stmtQuizzes->execute();
$quizzes = $stmtQuizzes->get_result()->fetch_all(MYSQLI_ASSOC);

// Inicializar resultados
$result = [];

// Verificar si se envió un curso y un quiz
if (isset($_POST['curso'], $_POST['quiz'])) {
    $cursoId = $_POST['curso'];
    $quizId = $_POST['quiz'];

    // Obtener los resultados para el curso y quiz seleccionado
    $sqlResult = 'SELECT mdl_user.firstname, mdl_quiz_grades.grade FROM mdl_quiz_grades INNER JOIN mdl_quiz ON mdl_quiz_grades.quiz = mdl_quiz.id INNER JOIN mdl_course ON mdl_quiz.course = mdl_course.id INNER JOIN mdl_user ON mdl_quiz_grades.userid = mdl_user.id WHERE mdl_quiz.id = ? AND mdl_course.id = ?';
    $stmtResult = $conn->prepare($sqlResult);
    $stmtResult->bind_param('ii', $quizId, $cursoId);
    $stmtResult->execute();
    $result = $stmtResult->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tabla de Resultados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
</head>
<body>
    
<a href="../index.php" class="my-4 text-center"><h4>Regresar al menu</h4></a>
    <div class="container">
        <form action="" method="post">
            <div class="mb-3">
                <label for="curso" class="form-label">Curso</label>
                <select class="form-select" id="curso" name="curso">
                    <?php foreach ($cursos as $curso) : ?>
                        <option value="<?php echo $curso['id']; ?>"><?php echo htmlspecialchars($curso['fullname']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="quiz" class="form-label">Quiz</label>
                <select class="form-select" id="quiz" name="quiz">
                    <?php foreach ($quizzes as $quiz) : ?>
                        <option value="<?php echo $quiz['id']; ?>"><?php echo htmlspecialchars($quiz['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Calificación</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['firstname']); ?></td>
                        <td><?php echo htmlspecialchars($row['grade']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
