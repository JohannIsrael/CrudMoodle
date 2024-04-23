<?php
include '../conexion.php';

function getInforme($year){
    global $conn;

    $query = 
    "
    SELECT MONTHNAME(FROM_UNIXTIME(c.startdate)) AS 'Mes', COUNT(c.id) AS 'Número de Cursos' FROM mdl_course c WHERE YEAR(FROM_UNIXTIME(c.startdate)) = '$year' GROUP BY MONTH(FROM_UNIXTIME(c.startdate)) ORDER BY MONTH(FROM_UNIXTIME(c.startdate));
    ";

    $statement = $conn->prepare($query);
    $statement->execute();

    $resultSet = $statement->get_result();
    $count = $resultSet->fetch_all(MYSQLI_ASSOC);

    return $count;
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
        <h2 class="pt-4">Cuantos cursos se impartieron en cada mes</h2>


        <form method="POST">
            <select class="form-select" name="curso_id">
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
            </select>
            <br>
            <button type="submit" class="btn btn-primary">Filtrar</button>
            
        </form>

        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th>Mes</th>
                    <th>Total Cursos</th>
                </tr>
            </thead>
            
                <?php foreach ($countAll as $count) : ?>
                    <tr>
                        <td><?= $count['Mes']; ?></td>
                        <td><?= $count['Número de Cursos']; ?></td>
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