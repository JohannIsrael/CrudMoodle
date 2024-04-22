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
SELECT mdl_course_categories.name as Categorias, mdl_course.fullname as Cursos
FROM mdl_course
INNER JOIN mdl_course_categories ON mdl_course.category = mdl_course_categories.id;
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
    <title>Lista de cursos por categoría</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
</head>
<body>
<a href="../index.php" class="my-4 text-center"><h4>Regresar al menu</h4></a>
<div class="container">
   
        <!-- Mostrar HTML después de que se envíe el formulario -->
        <h2 class="pt-4">Lista de cursos por categoría</h2>
        

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
