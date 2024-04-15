<?php
include '../conexion.php';

function get_categoria(){
    // Consulta categorias
    global $conn;
    $query = "SELECT id, name, coursecount FROM mdl_course_categories;";
    $statement = $conn->prepare($query);
    $statement->execute();

    $resultSet = $statement->get_result();
    $categorias = $resultSet->fetch_all(MYSQLI_ASSOC);

    return $categorias;
}

// Todas las categorias
$categorias = get_categoria();

// Total de categorias existentes
function get_TotalCategorias(){
    global $conn;
    $query = "SELECT COUNT(*) as total FROM mdl_course_categories;";
    $statement = $conn->prepare($query);
    $statement->execute();

    $resultSet = $statement->get_result();
    $totalCategorias = $resultSet->fetch_assoc()['total'];

    return $totalCategorias;
}

// Obtener el total de categorías
$totalCategorias = get_TotalCategorias();

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
        <form action="" method="post">
            <h2 class="pt-4">Total de categorias existentes: <?php echo $totalCategorias ?></h2>
        </form>

        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>coursecount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $categoria) : ?>
                    <tr>
                        <td><?= $categoria['id']; ?></td>
                        <td><?= $categoria['name']; ?></td>
                        <td><?= $categoria['coursecount']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
