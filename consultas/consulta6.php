<?php
include '../conexion.php';

// Obtener todos los cursos para el select
$sqlCursos = 'SELECT id, fullname FROM mdl_course';
$stmtCursos = $conn->prepare($sqlCursos);
$stmtCursos->execute();
$cursos = $stmtCursos->get_result()->fetch_all(MYSQLI_ASSOC);

// Inicializar resultados
$result = [];

// Verificar si se envió un curso
if (isset($_POST['curso'])) {
    $cursoId = $_POST['curso'];

    // Obtener los resultados para el curso seleccionado
    $sqlResult = 'SELECT USUARIO.firstname, CURSO.fullname FROM mdl_role_assignments AS ROL INNER JOIN mdl_user AS USUARIO ON USUARIO.id = ROL.userid INNER JOIN mdl_context AS CONTEXTO ON ROL.contextid = CONTEXTO.id AND CONTEXTO.contextlevel = 50 INNER JOIN mdl_course AS CURSO ON CURSO.id = CONTEXTO.instanceid WHERE ROL.roleid = 5 AND CURSO.id = ?';
    $stmtResult = $conn->prepare($sqlResult);
    $stmtResult->bind_param('i', $cursoId);
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
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Curso</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['firstname']); ?></td>
                        <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

