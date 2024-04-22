<?php
include '../conexion.php';

function getInforme(){
    global $conn;

    $query = 
    "
    SELECT mdl_user.firstname AS 'Nombre', mdl_user.lastname AS 'Apellidos', MAX(CASE WHEN mdl_user_info_field.shortname = 'genero' THEN mdl_user_info_data.data END) as 'Genero', MAX(CASE WHEN mdl_user_info_field.shortname = 'foraneo' THEN mdl_user_info_data.data END) as 'Foraneo', MAX(CASE WHEN mdl_user_info_field.shortname = 'ncontrol' THEN mdl_user_info_data.data END) as 'Número de control' FROM mdl_user INNER JOIN mdl_user_info_data ON mdl_user_info_data.userid = mdl_user.id INNER JOIN mdl_user_info_field ON mdl_user_info_field.id = mdl_user_info_data.fieldid GROUP BY mdl_user.id;
    ";

    $statement = $conn->prepare($query);
    $statement->execute();

    $resultSet = $statement->get_result();
    $count = $resultSet->fetch_all(MYSQLI_ASSOC);

    return $count;
}


$informes = getInforme();



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
        <h2 class="pt-4">Reporte que incluya: nombre, apellidos, número de control, género, foráneos.</h2>

        <!-- <?php
        echo "<pre>";
        print_r($informes);
        echo "</pre>";
        ?> -->

        <table class="table table-striped mt-5">
            <thead>
                <tr>

                    <th>Nombre (s)</th>
                    <th>Apellidos</th>
                    <th>Genero</th>
                    <th>Foraneo?</th>
                    <th>Numero de control</th>


                </tr>
            </thead>
            <tbody>
                <?php foreach ($informes as $count) : ?>
                    <tr>
                        <td><?= $count['Nombre']; ?></td>
                        <td><?= $count['Apellidos']; ?></td>
                        <td><?= $count['Genero']; ?></td>
                        <td><?= $count['Foraneo'] ? 'Si' : 'No'; ?></td>

                        <td><?= $count['Número de control']; ?></td>

                    </tr>
                <?php endforeach; ?>

                <?php if (!$informes) : ?>
                    <h2>Aun no hay resgistros</h2>
                <?php endif; ?>
            </tbody>


        </table>
    </div>
</body>
</html>
