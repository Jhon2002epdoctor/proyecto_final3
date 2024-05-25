<?php
$salir =  isset($_GET["salir"]) ? $_GET["salir"] : false; 


if($salir){
    session_start();
    session_destroy();
    header("Location: /proyecto_final/Vista/login.php");
}
?>
