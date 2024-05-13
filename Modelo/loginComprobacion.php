<?php

include '../conexion.php'; 
session_start();
 
if($_GET){
     
     $casas = []; 
     
    $usuario = isset($_GET['usuario']) ? $_GET['usuario'] : '';
    $contrasena = isset($_GET['contraseña']) ? $_GET['contraseña'] : '';
    $sql = "SELECT usuario, contrasena, id_usuario, rol FROM usuario WHERE usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
        while($row = $result->fetch_assoc()) {
          
            $valor1 = password_verify($contrasena, $row['contrasena']); 
            $valor2 = $usuario == $row['usuario'];
            if ($valor1  &&  $valor2) {
                $casas = [
                    "verificado" => "verificado",
                    'id' => $row['id_usuario'],
                    'rol' => $row['rol']
                ];
                $_SESSION["rol"]= $row['rol'];
            } else {
                $casas = ['error' => 'No se proporcionó un ID válido.'];
            }    
            
        }
     
    header("Content-Type: application/json"); 
    echo json_encode($casas);
    $stmt->close();
    $conexion->close();
}


?>