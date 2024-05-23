<?php

include '../../conexion.php';


$data = json_decode(file_get_contents("php://input"));


$descripcion = $data->descripcion ?? '';
$habitaciones = $data->habitaciones ?? 0;
$titulo = $data->tipo ?? '';
$precio = $data->precio ?? 0.0;
$comunidad = $data->comunidad ?? '';
$ciudad = $data->ciudad ?? '';
$destacado = $data->destacado ? 1 : 0;
$imagenes = $data->imagenes == "" ? [] : $data->imagenes; 
$oculto = $data->oculto ? 1 : 0;
$bano=  $data->banos ?? 0;
$metros=  $data->metros ?? 0; 


try {

    $conexion->begin_transaction();


            $sql_insert_casa = "INSERT INTO `casa` (`descprcion`, `habitaciones`, `titulo`, `precio`, `comunidad_autonoma`, `ciudad`, `destacado` ,`oculto`  , `banos` , `metros`)
            VALUES (?, ?, ?, ?, ?, ?, ? , ? , ? , ? )";
        $stmt_casa = $conexion->prepare($sql_insert_casa);
        $stmt_casa->bind_param("sisdssiiii", $descripcion, $habitaciones, $titulo, $precio, $comunidad, $ciudad, $destacado , $oculto , $bano , $metros);
        $stmt_casa->execute();
        $id_casa_insertada = $conexion->insert_id;


    $sql_insert_imagen = "INSERT INTO `imagenes` (`imagen`, `id_casa`, `ocultoImagen`) VALUES (?, ?, ?)";
    $stmt_insert = $conexion->prepare($sql_insert_imagen);
    $ocultoImagen = 0; 
    foreach ($imagenes as $imagen) {
        $stmt_insert->bind_param("sii", $imagen, $id_casa_insertada , $ocultoImagen);
        $stmt_insert->execute();
    }
    $stmt_insert->close();
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
