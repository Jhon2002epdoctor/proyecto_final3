<?php
require("../../config.php");
include "../../conexion.php";


$id = $_POST['id'] ?? 0;
$descripcion = $_POST['descripcion'] ?? '';
$habitaciones = $_POST['habitaciones'] ?? 0;
$titulo = $_POST['titulo'] ?? '';
$precio = $_POST['precio'] ?? 0.0;
$comunidad = $_POST['comunidad'] ?? '';
$ciudad = $_POST['ciudad'] ?? '';
$destacado = $_POST['destacado'] == "true"? 1 : 0 ;
$oculto = $_POST['oculto'] == "true"? 1 : 0 ;



if ($id <= 0) {
    echo json_encode(["success" => false, "message" => "ID de casa no válido."]);
    exit();
}

try {
    $conexion->begin_transaction();


    $sql_update_casa = "UPDATE `casa` SET `descprcion` = ?, `habitaciones` = ?, `titulo` = ?, `precio` = ?, `comunidad_autonoma` = ?, `ciudad` = ?, `destacado` = ?, `oculto` = ? WHERE `id_casa` = ?";
    $stmt_casa = $conexion->prepare($sql_update_casa);
    $stmt_casa->bind_param("sisdssiii", $descripcion, $habitaciones, $titulo, $precio, $comunidad, $ciudad, $destacado, $oculto, $id);
    $stmt_casa->execute();


    $imagenes = [];
    if (!empty($_FILES['imagenes']['name'][0])) {
        $targetDir = "../../img/";
        foreach ($_FILES['imagenes']['name'] as $key => $name) {
            $targetFile = $targetDir . basename($name);
            if (move_uploaded_file($_FILES['imagenes']['tmp_name'][$key], $targetFile)) {
                $imagenes[] =  basename($name);  
            }
        }
    }


    if (!empty($imagenes)) {
        $sql_insert_imagen = "INSERT INTO `imagenes` (`imagen`, `id_casa`, `ocultoImagen`) VALUES (?, ?, ?)";
        $stmt_insert = $conexion->prepare($sql_insert_imagen);
        $ocultoImagen = 0; 
        foreach ($imagenes as $imagen) {
            $stmt_insert->bind_param("sii", $imagen, $id, $ocultoImagen);
            $stmt_insert->execute();
        }
        $stmt_insert->close();
    }


    foreach ($checkboxDataArray as $checkboxData) {
        $checked = $checkboxData['checked'] ? 1 : 0;
        $dataId = $checkboxData['dataId'];
        $sql_update_imagen = "UPDATE `imagenes` SET `ocultoImagen` = ? WHERE `id_imagen` = ?";
        $stmt_update = $conexion->prepare($sql_update_imagen);
        $stmt_update->bind_param("ii", $checked, $dataId);
        $stmt_update->execute();
    }

    $conexion->commit();
    $response = ["success" => true, "message" => "Casa modificada correctamente"];
} catch (Exception $e) {
    $conexion->rollback();
    $response = ["success" => false, "message" => "Error al modificar la casa: " . $e->getMessage()];
}

header('Content-Type: application/json');
echo json_encode($response);

$conexion->close();
?>
