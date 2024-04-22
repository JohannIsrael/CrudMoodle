<?php
include '../conexion.php';

function getCountSex(){
    global $conn;

    $query = 
    "
    SELECT COUNT(CASE WHEN genero.data = 'Mujer' THEN 1 END) AS mujeres, COUNT(CASE WHEN genero.data = 'Hombre' THEN 1 END) AS hombres, COUNT(CASE WHEN genero.data = 'No binario' THEN 1 END) AS 'No binario' FROM mdl_user_info_data AS genero INNER JOIN mdl_user_info_field ON mdl_user_info_field.id = genero.fieldid WHERE mdl_user_info_field.shortname = 'genero';
    ";

    $statement = $conn->prepare($query);
    $statement->execute();

    $resultSet = $statement->get_result();
    $count = $resultSet->fetch_all(MYSQLI_ASSOC);

    return $count;
}


$countAll = getCountSex();



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

        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th>Mujeres</th>
                    <th>Hombres</th>
                    <th>No Binarios</th>
                </tr>
            </thead>
            <tbody>
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
