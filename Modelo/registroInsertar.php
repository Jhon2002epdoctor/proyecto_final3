<?php

include '../conexion.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
$data = json_decode(file_get_contents("php://input"));

    $nombre = $data->nombre ?? '';
    $usuario = $data->usuario ?? '';
    $email = $data->email ?? '';
    $contraseña = $data->contrasena ?? '';
    
$sql = "SELECT * FROM usuario WHERE usuario = '$usuario'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    echo json_encode( ["usuario" => "El usuario ya existe"]);
} else {

    $nombre = $conexion->real_escape_string($nombre);
    $email = $conexion->real_escape_string($email);
    $contrasena = password_hash($conexion->real_escape_string($contraseña), PASSWORD_DEFAULT); 
    $rol = "normal";

    $insertSql = "INSERT INTO usuario (nombre, usuario, email, contrasena , rol ) VALUES ('$nombre', '$usuario', '$email', '$contrasena', '$rol')";
    if ($conexion->query($insertSql)) {
        
    } else {
        
    }
    
echo json_encode( ["perfecto" => "Usuario creado correctamente"]);
}
 

$conexion->close();

}
?>
