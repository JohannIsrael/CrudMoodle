<?php
include '../conexion.php';

function getCountMForeing(){
    global $conn;

    $query = 
    "
    SELECT  COUNT(CASE WHEN genero.data = 'Mujer' AND foraneo.data = '1' THEN 1 END) AS 'Mujeres Foraneas' FROM mdl_user_info_data AS genero INNER JOIN mdl_user_info_field AS field_genero ON field_genero.id = genero.fieldid AND field_genero.shortname = 'genero' INNER JOIN mdl_user_info_data AS foraneo ON foraneo.userid = genero.userid INNER JOIN mdl_user_info_field AS field_foraneo ON field_foraneo.id = foraneo.fieldid AND field_foraneo.shortname = 'foraneo';

    ";

    $statement = $conn->prepare($query);
    $statement->execute();

    $resultSet = $statement->get_result();
    $count = $resultSet->fetch_all(MYSQLI_ASSOC);

    return $count;
}


$countForeing = getCountMForeing();



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
        <h2 class="pt-4">Cuántas mujeres foráneas hay</h2>

        <table class="table table-striped mt-5">
            <thead>
                <tr>

                    <th>Mujeres Foraneas</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($countForeing as $count) : ?>
                    <tr>
                        <td><?= $count['Mujeres Foraneas']; ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php if (!$countForeing) : ?>
                    <h2>Aun no hay resgistros</h2>
                <?php endif; ?>
            </tbody>


        </table>
    </div>
</body>
</html>
