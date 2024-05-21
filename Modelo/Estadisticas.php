<?php 

include '../conexion.php';

$response = [];


$query = "SELECT COUNT(*) AS total_fotos FROM imagenes";
$result = $conexion->query($query);
$row = $result->fetch_assoc();
$response['total_fotos'] = $row['total_fotos'];


$query = "SELECT COUNT(*) AS total_casas FROM casa";
$result = $conexion->query($query);
$row = $result->fetch_assoc();
$response['total_casas'] = $row['total_casas'];


$query = "SELECT COUNT(*) AS total_usuarios FROM usuario";
$result = $conexion->query($query);
$row = $result->fetch_assoc();
$response['total_usuarios'] = $row['total_usuarios'];


$query = "SELECT COUNT(*) AS total_megusta FROM megusta";
$result = $conexion->query($query);
$row = $result->fetch_assoc();
$response['total_megusta'] = $row['total_megusta'];

echo json_encode($response);

?>