
<?php

require_once dirname(__DIR__) . '../../config.php'; 

session_start();

$salir = isset($_GET["salir"]) ? $_GET["salir"] : false;

if ($salir) {
    // Destruir la sesión
    session_destroy();
        header("Location: ". BASE_URL ."/Vista/login.php");

    exit();
}
?>