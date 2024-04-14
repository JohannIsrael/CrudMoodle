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

    // Obtener el promedio de calificaciones para el curso y quiz seleccionado
    // Obtener el promedio de calificaciones para el curso y quiz seleccionado
$sqlResult = 'SELECT AVG(mdl_quiz_grades.grade) AS Promedio FROM mdl_quiz_grades INNER JOIN mdl_quiz ON mdl_quiz_grades.quiz = mdl_quiz.id INNER JOIN mdl_course ON mdl_quiz.course = mdl_course.id INNER JOIN mdl_user ON mdl_quiz_grades.userid = mdl_user.id WHERE mdl_quiz.id = 1 AND mdl_course.id = ?';
$stmtResult = $conn->prepare($sqlResult);
$stmtResult->bind_param('i', $cursoId);
$stmtResult->execute();
$result = $stmtResult->get_result()->fetch_assoc();

// Verificar si la clave "Promedio" existe en el array
if (isset($result['Promedio'])) {
    $promedio = $result['Promedio'];
} else {
    $promedio = 'No disponible';
}

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Promedio de Calificaciones</title>
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
                    <th>Promedio de Calificaciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>
    <?php 
    if (isset($result['Promedio']) && !is_null($result['Promedio'])) {
        echo htmlspecialchars($result['Promedio']); 
    }
    ?>
</td>

                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
