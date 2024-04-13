<?php

$servidor = "localhost";
$usuario = "nombre_de_usuario";
$password = "contraseña_base_de_datos";
$base_datos = "nombre_de_base_de_datos";

// Crear conexión
$conn = new mysqli($servidor, $usuario, $password, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida - ERROR de conexión: " . $conn->connect_error);
}
echo "Conexión OK";

?>
