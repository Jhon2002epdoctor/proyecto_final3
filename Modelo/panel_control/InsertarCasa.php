<?php
// Conectar a la base de datos
include '../../conexion.php';

// Recibe los datos enviados desde JavaScript
$data = json_decode(file_get_contents("php://input"));


$descripcion = $data->descripcion ?? '';
$habitaciones = $data->habitaciones ?? 0;
$titulo = $data->titulo ?? '';
$precio = $data->precio ?? 0.0;
$comunidad = $data->comunidad ?? '';
$ciudad = $data->ciudad ?? '';
$destacado = $data->destacado ? 1 : 0;
$imagenes = $data->imagenes == "" ? [] : $data->imagenes; 
$oculto = $data->oculto ? 1 : 0;

try {
    // Iniciar transacción
    $conexion->begin_transaction();

    // Actualizar información de la casa
            $sql_insert_casa = "INSERT INTO `casa` (`descprcion`, `habitaciones`, `titulo`, `precio`, `comunidad_autonoma`, `ciudad`, `destacado` ,`oculto`)
            VALUES (?, ?, ?, ?, ?, ?, ? , ?)";
        $stmt_casa = $conexion->prepare($sql_insert_casa);
        $stmt_casa->bind_param("sisdssii", $descripcion, $habitaciones, $titulo, $precio, $comunidad, $ciudad, $destacado , $oculto);
        $stmt_casa->execute();
        $id_casa_insertada = $conexion->insert_id;
    // Insertar nuevas imágenes

    if(count($imagenes) != 0){

    $sql_insert_imagen = "INSERT INTO `imagenes` (`imagen`, `id_casa`, `ocultoImagen`) VALUES (?, ?, ?)";
    $stmt_insert = $conexion->prepare($sql_insert_imagen);
    $ocultoImagen = 0; 
    foreach ($imagenes as $imagen) {
        $stmt_insert->bind_param("sii", $imagen, $id_casa_insertada , $ocultoImagen);
        $stmt_insert->execute();
    }
    $stmt_insert->close();
   } 
    // Confirmar la transacción
    $conexion->commit();
    $response = ["success" => true, "message" => "Casa modificada correctamente"];
} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $conexion->rollback();
    $response = ["success" => false, "message" => "Error al modificar la casa: " . $e->getMessage()];
}

// Enviar respuesta JSON
header('Content-Type: application/json');
echo json_encode($response);

// Cerrar conexión
$conexion->close();
?>
