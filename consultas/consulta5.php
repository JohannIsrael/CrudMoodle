<?php
include '../conexion.php';

function get_Table($query){
    global $conn;
    $statement = $conn->prepare($query);
    $statement->execute();
    $resultSet = $statement->get_result();
    $alumnosxcurso = $resultSet->fetch_all(MYSQLI_ASSOC);
    return $alumnosxcurso;
}

function get_Keys($array){
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

if (isset($_POST['tabla'])) {
    $value = $_POST['tabla'];
}

switch ($value) {
    case '0': // Archivos
        $query = "SELECT id, component, filearea, filename, author, mimetype FROM moodle.mdl_files;";
        break;
    case '1': // Tareas
        $query = "SELECT id, course, name, intro, grade FROM mdl_assign;";
        break;
    case '2': // Cuestionarios
        $query = "SELECT id, course, name, intro, timeopen FROM mdl_quiz;";
        break;
    case '3': // Foros
        $query = "SELECT id, course, type, name, intro FROM mdl_forum;";
        break;
    case '4': // Talleres
        $query = "SELECT id, course, grade, evaluation, name FROM mdl_workshop;";
        break;
    case '5': // Lecciones
        $query = "SELECT id, course, intro, grade, available FROM mdl_lesson;";
        break;
    default:
        "";
        break;
}

if (isset($_POST['tabla'])) {
    $objects = get_Table($query);
    $keys = get_Keys($objects);
}

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
    <title>Lista de Categorias</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
</head>
<body>
<a href="../index.php" class="my-4 text-center"><h4>Regresar al menu</h4></a>
<div class="container">
    <?php if ($_SERVER['REQUEST_METHOD'] !== 'POST') : ?>
        <!-- Mostrar HTML antes de que se envíe el formulario -->
        <h2 class="pt-4">Tablas Afectadas</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="tabla" class="form-label">Seleccione una tabla</label>
                <select class="form-select" id="tabla" name="tabla" onchange="this.form.submit()">  
                    <option value="">-- Selecciona una opción --</option>                  
                    <option value="0">Archivos</option>                 
                    <option value="1">Tareas</option>                 
                    <option value="2">Cuestionarios</option>                 
                    <option value="3">Foros</option>                 
                    <option value="4">Talleres</option>                 
                    <option value="5">Lecciones</option>                 
                </select>
            </div>
        </form>
    <?php endif; ?>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
        <!-- Mostrar HTML después de que se envíe el formulario -->
        <h2 class="pt-4">Tablas Afectadas</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="tabla" class="form-label">Seleccione una tabla</label>
                <select class="form-select" id="tabla" name="tabla" onchange="this.form.submit()" >  
                    <option value="">-- Selecciona una opción --</option>               
                    <option value="0">Archivos</option>                 
                    <option value="1">Tareas</option>                 
                    <option value="2">Cuestionarios</option>                 
                    <option value="3">Foros</option>                 
                    <option value="4">Talleres</option>                 
                    <option value="5">Lecciones</option>                 
                </select>
            </div>
        </form>

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
    <?php endif; ?>
</div>
</body>
</html>
