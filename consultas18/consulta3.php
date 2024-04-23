<?php
include '../conexion.php';

function getInforme($profesor){
    global $conn;

    $query = 
    "
    SELECT c.fullname AS 'Nombre del Curso' FROM mdl_course c JOIN mdl_context ctx ON c.id = ctx.instanceid JOIN mdl_role_assignments ra ON ctx.id = ra.contextid JOIN mdl_user u ON ra.userid = u.id WHERE ra.roleid = 3 AND CONCAT(u.firstname, ' ', u.lastname) = '$profesor' GROUP BY c.id;;
    ";

    $statement = $conn->prepare($query);
    $statement->execute();

    $resultSet = $statement->get_result();
    $count = $resultSet->fetch_all(MYSQLI_ASSOC);

    return $count;
}

function getProfs(){
    global $conn;

    $query = "SELECT DISTINCT CONCAT(u.firstname, ' ', u.lastname) AS 'Nombre del Profesor' FROM mdl_user u JOIN mdl_role_assignments ra ON u.id = ra.userid WHERE ra.roleid = 3;";

    $statement = $conn->prepare($query);
    $statement->execute();

    $resultSet = $statement->get_result();
    $profs = $resultSet->fetch_all(MYSQLI_ASSOC);


    return $profs;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $countAll = getInforme($_POST['curso_id']);
} else {
    $countAll = getInforme(null);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de cursos por profesor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
</head>
<body>
<a href="../index.php" class="my-4 text-center"><h4>Regresar al menu</h4></a>
<div class="container">
   
        <!-- Mostrar HTML después de que se envíe el formulario -->
        <h2 class="pt-4">Lista de cursos por profesor</h2>

        <form method="POST">
            <select name="curso_id">
                <?php foreach (getProfs() as $genero) : ?>
                    <option value="<?= $genero['Nombre del Profesor']; ?>"><?= $genero['Nombre del Profesor']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>

        

        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th>Cursos</th>
                </tr>
            </thead>
            
                <?php foreach ($countAll as $count) : ?>
                    <tr>
                        <td><?= $count['Nombre del Curso']; ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php if (!$countAll) : ?>
                    <h2>Aun no hay resgistros</h2>
                <?php endif; ?>
            </tbody>
    
</div>
</body>
</html>
