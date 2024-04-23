<?php
include '../conexion.php';

function getInforme(){
    global $conn;

    // $query = 
    // "
    // SELECT c.category AS 'Categoría', c.fullname AS 'Nombre del Curso', CONCAT(u.firstname, ' ', u.lastname) AS 'Profesor', FROM_UNIXTIME(c.startdate, '%Y-%m-%d') AS 'Fecha Inicio', FROM_UNIXTIME(c.enddate, '%Y-%m-%d') AS 'Fecha Finalización', (SELECT COUNT(ra.userid) FROM mdl_role_assignments ra WHERE ra.contextid = ctx.id AND ra.roleid = 5) AS 'Número de Participantes' FROM mdl_course c JOIN mdl_context ctx ON c.id = ctx.instanceid JOIN mdl_role_assignments ra ON ctx.id = ra.contextid JOIN mdl_user u ON ra.userid = u.id WHERE ra.roleid = 3 GROUP BY c.id;
    // ";

    $query = 
    "
    SELECT cat.name AS 'Categoría', c.fullname AS 'Nombre del Curso', CONCAT(u.firstname, ' ', u.lastname) AS 'Profesor', FROM_UNIXTIME(c.startdate, '%Y-%m-%d') AS 'Fecha Inicio', FROM_UNIXTIME(c.enddate, '%Y-%m-%d') AS 'Fecha Finalización', (SELECT COUNT(ra.userid) FROM mdl_role_assignments ra WHERE ra.contextid = ctx.id AND ra.roleid = 5) AS 'Número de Participantes' FROM mdl_course c JOIN mdl_course_categories cat ON c.category = cat.id JOIN mdl_context ctx ON c.id = ctx.instanceid JOIN mdl_role_assignments ra ON ctx.id = ra.contextid JOIN mdl_user u ON ra.userid = u.id WHERE ra.roleid = 3 GROUP BY c.id;
    ";

    $statement = $conn->prepare($query);
    $statement->execute();

    $resultSet = $statement->get_result();
    $count = $resultSet->fetch_all(MYSQLI_ASSOC);

    return $count;
}

$lista = getInforme()

?>

<!DOCTYPE html>
<html>
<head>
    <title>Categoría, nombre del curso, profesor, fecha inicio, fecha finalización, número de participantes.</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
</head>
<body>
<a href="../index.php" class="my-4 text-center"><h4>Regresar al menu</h4></a>
<div class="container">
   
        <!-- Mostrar HTML después de que se envíe el formulario -->
        <h2 class="pt-4">Categoría, nombre del curso, profesor, fecha inicio, fecha finalización, número de participantes.</h2>
        

        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th>Categoría</th>
                    <th>Nombre del Curso</th>
                    <th>Profesor</th>
                    <th>Fecha inicio</th>
                    <th>Fecha finalización</th>
                    <th>Número de participantes</th>

                </tr>
            </thead>
            
                <?php foreach ($lista as $count) : ?>
                    <tr>
                        <td><?= $count['Categoría']; ?></td>
                        <td><?= $count['Nombre del Curso']; ?></td>
                        <td><?= $count['Profesor']; ?></td>
                        <td><?= $count['Fecha Inicio']; ?></td>
                        <td><?= $count['Fecha Finalización']; ?></td>
                        <td><?= $count['Número de Participantes']; ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php if (!$lista) : ?>
                    <h2>Aun no hay resgistros</h2>
                <?php endif; ?>
            </tbody>


        </table>
    
</div>
</body>
</html>
