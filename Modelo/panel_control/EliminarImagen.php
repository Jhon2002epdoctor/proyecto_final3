<?php

include '../../conexion.php';

$idImagen = isset($_GET['id_imagen']) ? intval($_GET['id_imagen']) : 0;

if ($idImagen > 0) {
    // Consulta para eliminar la imagen con el id específico
    $query = "DELETE FROM imagenes WHERE id_imagen = ?";
    
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $idImagen);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => 'Imagen eliminada correctamente.']);
    } else {
        echo json_encode(['error' => 'No se encontró la imagen o no se pudo eliminar.']);
    }
    
    $stmt->close();
} else {
    echo json_encode(['error' => 'No se proporcionó un ID válido para la imagen.']);
}

?>
