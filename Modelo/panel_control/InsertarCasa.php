<?php
require("../../config.php");
include "../../conexion.php"; 

// Recuperar datos del formulario
$descripcion = $_POST['descripcion'] ?? '';
$habitaciones = $_POST['habitaciones'] ?? 0;
$titulo = $_POST['tipo'] ?? '';
$precio = $_POST['precio'] ?? 0.0;
$comunidad = $_POST['comunidad'] ?? '';
$ciudad = $_POST['ciudad'] ?? '';
$destacado = $_POST['destacado'] ?? 0;
$oculto = $_POST['oculto'] ?? 0;
$bano = $_POST['banos'] ?? 0;
$metros = $_POST['metros'] ?? 0;

try {
    $conexion->begin_transaction();

    // Insertar datos de la casa
    $sql_insert_casa = "INSERT INTO `casa` (`descprcion`, `habitaciones`, `titulo`, `precio`, `comunidad_autonoma`, `ciudad`, `destacado`, `oculto`, `banos`, `metros`)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_casa = $conexion->prepare($sql_insert_casa);
    $stmt_casa->bind_param("sisdssiiii", $descripcion, $habitaciones, $titulo, $precio, $comunidad, $ciudad, $destacado, $oculto, $bano, $metros);
    $stmt_casa->execute();
    $id_casa_insertada = $conexion->insert_id;

    // Manejar la subida de imágenes
    $imagenes = [];
    if (!empty($_FILES['imagenes']['name'][0])) {
        $targetDir = "../../img/";
        foreach ($_FILES['imagenes']['name'] as $key => $name) {
            $targetFile = $targetDir . basename($name);
            if (move_uploaded_file($_FILES['imagenes']['tmp_name'][$key], $targetFile)) {
                $imagenes[] = basename($name);  // Guarda la ruta de la imagen para insertar en la base de datos
            }
        }
    }

    // Insertar las rutas de las imágenes en la base de datos
    if (!empty($imagenes)) {
        $sql_insert_imagen = "INSERT INTO `imagenes` (`imagen`, `id_casa`, `ocultoImagen`) VALUES (?, ?, ?)";
        $stmt_insert = $conexion->prepare($sql_insert_imagen);
        $ocultoImagen = 0; 
        foreach ($imagenes as $imagen) {
            $stmt_insert->bind_param("sii", $imagen, $id_casa_insertada, $ocultoImagen);
            $stmt_insert->execute();
        }
        $stmt_insert->close();
    }

    $conexion->commit();
    $response = ["success" => true, "message" => "Casa modificada correctamente"];
} catch (Exception $e) {
     echo $e; 
    $response = ["success" => false, "message" => "Error al modificar la casa: " . $e->getMessage()];
}

header('Content-Type: application/json');
echo json_encode($response);

$conexion->close();
?>
