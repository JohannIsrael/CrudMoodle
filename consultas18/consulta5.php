<?php
include '../conexion.php';

function getInforme($genero, $mes){
    global $conn;

    // if($genero === "Otra cosa"){
    //     $genero = "No Binarios";
    // }

    $query = 
    "
    SELECT COUNT(DISTINCT u.id) as 'Total' FROM mdl_user u JOIN mdl_role_assignments ra ON u.id = ra.userid JOIN mdl_context ctx ON ra.contextid = ctx.id JOIN mdl_course c ON ctx.instanceid = c.id JOIN mdl_user_info_data genero ON u.id = genero.userid JOIN mdl_user_info_field field ON genero.fieldid = field.id WHERE ra.roleid = 5 AND field.shortname = 'genero' AND genero.data = '$genero' AND MONTH(FROM_UNIXTIME(c.startdate)) = '$mes';

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
    $countAll = getInforme($_POST['curso_id'], $_POST['mes_id']);
} else {
    $countAll = getInforme(null, null);
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
        <h2 class="pt-4">Cuantos participantes hay dependiendo del genero.</h2>

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
                    
            <select class="form-select" aria-label="Meses" name='mes_id'>
                <option selected>Selecciona un mes</option>
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>

                    <br>

            <button type="submit" class="btn btn-primary">Filtrar</button>
            
        </form>

        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th>Total</th>
                </tr>
            </thead>
            
                <?php foreach ($countAll as $count) : ?>
                    <tr>
                        <td><?= $count['Total']; ?></td>
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
