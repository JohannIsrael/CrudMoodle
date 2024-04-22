<?php
include '../conexion.php';

function getTable($query){
    global $conn;
    $statement = $conn->prepare($query);
    $statement->execute();
    $resultSet = $statement->get_result();
    $alumnosxcurso = $resultSet->fetch_all(MYSQLI_ASSOC);
    return $alumnosxcurso;
}

function getKeys($array){
    $keys = [];
    foreach ($array as $subArray) {
        $keys = array_merge($keys, array_keys($subArray));
    }
    return array_unique($keys);
}

$value = NULL;
$query = NULL;
$objects = NULL;
$keys = NULL;


$query = "
SELECT distinct mdl_user.username, mdl_user.firstname, mdl_course.fullname as Curso, mdl_role.shortname as rol
FROM mdl_user_enrolments 
INNER JOIN mdl_user ON mdl_user_enrolments.userid = mdl_user.id
INNER JOIN mdl_enrol ON mdl_user_enrolments.enrolid = mdl_enrol.id
INNER JOIN mdl_course ON mdl_enrol.courseid = mdl_course.id
INNER JOIN mdl_role_assignments ON mdl_role_assignments.userid = mdl_user.id
INNER JOIN mdl_role ON mdl_role.id = mdl_role_assignments.roleid
where mdl_role.shortname = 'teacher';
";


$objects = getTable($query);
$keys = getKeys($objects);


// echo $value;
// echo '<br>';
// echo $query;
// echo '<br>';
// echo print_r($objects);
// echo '<br>';
// echo print_r($keys);

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
        

        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <?php foreach ($keys as $value) : ?>
                        <th><?= $value; ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($objects as $object) : ?>
                    <tr>
                        <?php foreach ($keys as $value) : ?>
                            <td><?= $object[$value]; ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
            <?php if (!$objects) : ?>
                <h2>Aun no hay resgistros</h2>
            <?php endif; ?>
    
</div>
</body>
</html>
