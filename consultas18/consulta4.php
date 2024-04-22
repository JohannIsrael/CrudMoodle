<?php
include '../conexion.php';

function get_Table($mes){
    global $conn;
    $query = "
    SELECT fullname as Curso, DATE_FORMAT(FROM_UNIXTIME(startdate), '%Y-%m-%d %H:%i:%s') AS 'Fecha inicio', DATE_FORMAT(FROM_UNIXTIME(enddate), '%Y-%m-%d %H:%i:%s') AS 'Fecha final' 
    FROM mdl_course 
    WHERE MONTH(FROM_UNIXTIME(startdate)) = $mes 
    AND MONTH(FROM_UNIXTIME(enddate)) = $mes;
    ";
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

$mes = NULL;
$query = NULL;
$objects = NULL;
$keys = NULL;

if (isset($_POST['mes'])) {
    $mes = $_POST['mes'];
}

if (isset($_POST['mes'])) {
    $objects = get_Table($mes);
    $keys = get_Keys($objects);
}

// echo $mes;
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
    <title>Lista de cursos por mes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
</head>
<body>
<a href="../index.php" class="my-4 text-center"><h4>Regresar al menu</h4></a>
<div class="container">
    <?php if ($_SERVER['REQUEST_METHOD'] !== 'POST') : ?>
        <!-- Mostrar HTML antes de que se envíe el formulario -->
        <h2 class="pt-4">Lista de cursos por mes</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="mese" class="form-label">Seleccione un mes</label>
                <select class="form-select" id="meses" name="mes" onchange="this.form.submit()">  
                    <option value="">-- Selecciona una opción --</option>                  
                    <option value="01">Enero</option>                 
                    <option value="02">Febrero</option>                 
                    <option value="03">Marzo</option>                 
                    <option value="04">Abril</option>                 
                    <option value="05">Mayo</option>                 
                    <option value="06">Junio</option>                 
                    <option value="07">Julio</option>                 
                    <option value="08">Agosto</option>                 
                    <option value="09">Septiembre</option>                 
                    <option value="10">Octubre</option>                 
                    <option value="11">Nomviembre</option>                 
                    <option value="12">Diciembre</option>                 
                </select>
            </div>
        </form>
    <?php endif; ?>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
        <!-- Mostrar HTML después de que se envíe el formulario -->
        <h2 class="pt-4">Lista de cursos por mes</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="meses" class="form-label">Seleccione un mes</label>
                <select class="form-select" id="meses" name="mes" onchange="this.form.submit()" >  
                <option value="">-- Selecciona una opción --</option>                  
                    <option value="01">Enero</option>                 
                    <option value="02">Febrero</option>                 
                    <option value="03">Marzo</option>                 
                    <option value="04">Abril</option>                 
                    <option value="05">Mayo</option>                 
                    <option value="06">Junio</option>                 
                    <option value="07">Julio</option>                 
                    <option value="08">Agosto</option>                 
                    <option value="09">Septiembre</option>                 
                    <option value="10">Octubre</option>                 
                    <option value="11">Nomviembre</option>                 
                    <option value="12">Diciembre</option>                 
                </select>
            </div>
        </form>

        <h2>MES: <?= $mes ?></h2>
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
