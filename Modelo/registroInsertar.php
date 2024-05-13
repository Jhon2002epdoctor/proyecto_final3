<?php

include '../conexion.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $contraseña = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';
    


$sql = "SELECT * FROM usuario WHERE usuario = '$usuario'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    echo "El nombre de usuario ya está en uso. Por favor, elige otro.";
} else {

    $nombre = $conexion->real_escape_string($nombre);
    $email = $conexion->real_escape_string($email);
    $contrasena = password_hash($conexion->real_escape_string($contraseña), PASSWORD_DEFAULT); 
    $rol = "normal";

    $insertSql = "INSERT INTO usuario (nombre, usuario, email, contrasena , rol ) VALUES ('$nombre', '$usuario', '$email', '$contrasena', '$rol')";
    if ($conexion->query($insertSql)) {
        
    } else {
        
    }
}

$conexion->close();

}
?>
