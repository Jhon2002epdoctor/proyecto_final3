<?php
include '../../conexion.php';

$idCasa = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($idCasa > 0) {
    // Obtener el valor actual de `oculto` y cambiarlo al valor opuesto
    $query = "SELECT oculto FROM casa WHERE id_casa = ?";
    if ($stmt = $conexion->prepare($query)) {
        $stmt->bind_param("i", $idCasa);
        $stmt->execute();
        $stmt->bind_result($oculto);
        $stmt->fetch();
        $stmt->close();

        $nuevoValorOculto = $oculto ? 0 : 1;

        // Actualizar el valor de `oculto`
        $updateQuery = "UPDATE casa SET oculto = ? WHERE id_casa = ?";
        if ($updateStmt = $conexion->prepare($updateQuery)) {
            $updateStmt->bind_param("ii", $nuevoValorOculto, $idCasa);
            $resultado = $updateStmt->execute();
            $updateStmt->close();

            $response = [
                'success' => $resultado ? 'Valor actualizado correctamente' : 'Error al actualizar',
                'nuevoValorOculto' => $nuevoValorOculto
            ];
        } else {
            $response = ['success' => 'Error al preparar la actualización'];
        }
    } else {
        $response = ['success' => 'Error al preparar la consulta'];
    }
} else {
    $response = ['success' => 'ID de casa no válido'];
}

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
echo json_encode($response);
?>
