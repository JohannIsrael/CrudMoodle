<?php
include '../conexion.php';

// Crea la consulta SQL
$sql = "SELECT COUNT(*) as total FROM mdl_user";

// Ejecuta la consulta SQL
$result = $conn->query($sql);

// Procesa los resultados
if ($result->num_rows > 0) {
    // Muestra los datos de cada fila
    while($row = $result->fetch_assoc()) {
        $total = $row["total"];
    }
} else {
    echo "0 resultados";
}

// Cierra la conexión
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Constulta 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body class='d-flex justify-content-center aling-items-center'  style="height: 100%;
    margin: 0;
    padding: 0;">

    <button class='btn btn-primary' onclick="mostrarAlerta()">Mostrar total</button>

    <script>
        function mostrarAlerta() {
            alert("Total de usuarios en moodle: <?php echo $total; ?>");
        }
    </script>
</body>
</html>
