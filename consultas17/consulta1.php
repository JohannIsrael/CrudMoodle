<?php
include '../conexion.php';

function getInforme($genero){
    global $conn;

    $query = 
    "
    SELECT COUNT(CASE WHEN genero.data = 'Mujer' THEN 1 END) AS mujeres, COUNT(CASE WHEN genero.data = 'Hombre' THEN 1 END) AS hombres, COUNT(CASE WHEN genero.data = 'Otra cosa' THEN 1 END) AS 'No binario' FROM mdl_user_info_data AS genero INNER JOIN mdl_user_info_field ON mdl_user_info_field.id = genero.fieldid WHERE mdl_user_info_field.shortname = 'genero' and genero.data = '$genero';
    ";

    $statement = $conn->prepare($query);
    $statement->execute();

    $resultSet = $statement->get_result();
    $count = $resultSet->fetch_all(MYSQLI_ASSOC);

    return $count;
}

function getGenero(){
    global $conn;

    $query = "SELECT mdl_user_info_field.param1 FROM mdl_user_info_field WHERE mdl_user_info_field.id = 1;";

    $statement = $conn->prepare($query);
    $statement->execute();

    $resultSet = $statement->get_result();
    $generos = $resultSet->fetch_all(MYSQLI_ASSOC);

    $param1 = $generos[0]['param1'];
    $parts = explode("\n", $param1);

    // $mujer = $parts[0];
    // $hombre = $parts[1];
    // $otraCosa = $parts[2];


    return $parts;
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
    <title>Lista de Categorias</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
</head>
<body>
<a href="../index.php" class="my-4 text-center"><h4>Regresar al menu</h4></a>
    <div class="container">
        <h2 class="pt-4">Tener como entrada el género y contar cuántos hay de cada uno.</h2>

        <!-- <?php
        echo "<pre>";
        print_r(getGenero());
        echo "</pre>";
        ?> -->

        <form method="POST">
            <select class="form-select" name="curso_id">
                <?php foreach (getGenero() as $genero) : ?>
                    <option value="<?= $genero; ?>"><?= $genero; ?></option>
                <?php endforeach; ?>
            </select>
            <br> 
            <button type="submit" class="btn btn-primary">Filtrar</button>
            
        </form>

        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th>Mujeres</th>
                    <th>Hombres</th>
                    <th>No Binarios</th>
                </tr>
            </thead>
            
                <?php foreach ($countAll as $count) : ?>
                    <tr>
                        <td><?= $count['mujeres']; ?></td>
                        <td><?= $count['hombres']; ?></td>
                        <td><?= $count['No binario']; ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php if (!$countAll) : ?>
                    <h2>Aun no hay resgistros</h2>
                <?php endif; ?>
            </tbody>


        </table>
    </div>
</body>
</html>
