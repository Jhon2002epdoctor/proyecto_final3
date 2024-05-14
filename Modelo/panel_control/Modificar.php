
<?php
include '../../conexion.php'; 

$data = json_decode(file_get_contents("php://input"));

$id = $data->id;
$descripcion = $data->descripcion;
$habitaciones = $data->habitaciones;
$titulo = $data->titulo;
$precio = $data->precio;
$comunidad = $data->comunidad;
$ciudad = $data->ciudad;
$destacado = $data->destacado ? 1 : 0;
$imagenes = $data->imagenes;
$idsOcultar = $data->checkboxDataArray;
$oculto = $data->oculto ? 1 : 0;


$updateCasaQuery = "UPDATE casa SET descprcion = ?, habitaciones = ?, titulo = ?, precio = ?, comunidad_autonoma = ?, ciudad = ?, destacado = ? , oculto = ? WHERE id_casa = ?" ;
$stmtCasa = $conexion->prepare($updateCasaQuery);
$stmtCasa->bind_param("sisdsssii", $descripcion, $habitaciones, $titulo, $precio, $comunidad, $ciudad, $destacado,$oculto,$id);


if ($stmtCasa->execute()) {

    foreach ($idsOcultar as $idOcultar) {
      $valorOculto =  $idOcultar->checked ? 1 : 0 ; 
      $updateQuery = "UPDATE imagenes SET ocultoImagen = $valorOculto WHERE id_imagen = ?";
      $stmt = $conexion->prepare($updateQuery);
      $stmt->bind_param("i", $idOcultar->dataId);
      $stmt->execute();
      $stmt->close();
  }
  

  $insertImagenQuery = "INSERT INTO imagenes (`imagen`, `id_casa` , `ocultoImagen`) VALUES (?, ?, ?)";
  $stmtImagen = $conexion->prepare($insertImagenQuery);
  $ocultoImagen = 0; 
  foreach ($imagenes as $imagenBase64) {
      $stmtImagen->bind_param("sii", $imagenBase64, $id , $ocultoImagen);
      $stmtImagen->execute();
  }
  
  $stmtImagen->close();
    $response = ["success" => true, "message" => "Casa y/o imágenes modificadas correctamente"];
} else {
    $response = ["success" => false, "message" => "Error al actualizar los datos de la casa"];
}

$stmtCasa->close();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
echo json_encode($response);
?>
