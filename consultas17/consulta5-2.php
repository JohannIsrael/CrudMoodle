<?php
include '../conexion.php';

function getInforme($curso_id){
    global $conn;

    if ($curso_id === null) {
        $query = 
        "
        SELECT mdl_user.firstname AS 'Nombre', mdl_user.lastname AS 'Apellidos', MAX(CASE WHEN mdl_user_info_field.shortname = 'genero' THEN mdl_user_info_data.data END) as 'Genero', MAX(CASE WHEN mdl_user_info_field.shortname = 'foraneo' THEN mdl_user_info_data.data END) as 'Foraneo', MAX(CASE WHEN mdl_user_info_field.shortname = 'ncontrol' THEN mdl_user_info_data.data END) as 'Número de control' FROM mdl_user INNER JOIN mdl_user_info_data ON mdl_user_info_data.userid = mdl_user.id INNER JOIN mdl_user_info_field ON mdl_user_info_field.id = mdl_user_info_data.fieldid GROUP BY mdl_user.id;
        ";

    } else {
        $query = 
        "
        SELECT mdl_user.firstname AS 'Nombre', mdl_user.lastname AS 'Apellidos', 
        MAX(CASE WHEN mdl_user_info_field.shortname = 'genero' THEN mdl_user_info_data.data END) as 'Genero', 
        MAX(CASE WHEN mdl_user_info_field.shortname = 'foraneo' THEN mdl_user_info_data.data END) as 'Foraneo', 
        MAX(CASE WHEN mdl_user_info_field.shortname = 'ncontrol' THEN mdl_user_info_data.data END) as 'Número de control' 
        FROM mdl_user 
        INNER JOIN mdl_user_info_data ON mdl_user_info_data.userid = mdl_user.id 
        INNER JOIN mdl_user_info_field ON mdl_user_info_field.id = mdl_user_info_data.fieldid 
        INNER JOIN mdl_user_enrolments ON mdl_user.id = mdl_user_enrolments.userid 
        INNER JOIN mdl_enrol ON mdl_user_enrolments.enrolid = mdl_enrol.id 
        INNER JOIN mdl_course ON mdl_enrol.courseid = mdl_course.id 
        INNER JOIN mdl_context ON mdl_context.instanceid = mdl_course.id 
        INNER JOIN mdl_role_assignments ON mdl_role_assignments.contextid = mdl_context.id AND mdl_role_assignments.userid = mdl_user.id 
        WHERE mdl_course.id = '$curso_id' AND mdl_role_assignments.roleid = 5 
        GROUP BY mdl_user.id;


        ";
        
    }

    $statement = $conn->prepare($query);
    
    $statement->execute();

    $resultSet = $statement->get_result();
    $count = $resultSet->fetch_all(MYSQLI_ASSOC);

    return $count;
}




function getCursos(){
    global $conn;

    $query = "SELECT mdl_course.id, mdl_course.fullname AS nombre FROM mdl_course;";

    $statement = $conn->prepare($query);
    $statement->execute();

    $resultSet = $statement->get_result();
    $cursos = $resultSet->fetch_all(MYSQLI_ASSOC);

    return $cursos;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $informes = getInforme($_POST['curso_id']);
} else {
    $informes = getInforme(null);
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
        <h2 class="pt-4">Reporte que incluya: nombre, apellidos, número de control, género, foráneos.</h2>
        <p>Filtrado por un curso en especifico</p>
        <form method="POST">
            <select name="curso_id">
                <?php foreach (getCursos() as $curso) : ?>
                    <option value="<?= $curso['id']; ?>"><?= $curso['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-primary">Filtrar</button>
            
        </form>


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
