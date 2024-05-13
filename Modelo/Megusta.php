<?php

include "../conexion.php";

$data = json_decode(file_get_contents("php://input"));

if (isset($data->id_usuario) && isset($data->id_casa)) {
    $id_usuario = $data->id_usuario;
    $id_casa = $data->id_casa;

    $checkSql = "SELECT * FROM megusta WHERE id_usuario = ? AND id_casa = ?";
    $checkStmt = $conexion->prepare($checkSql);

    if ($checkStmt === false) {
        $response = ["success" => false, "message" => "Error al preparar la declaración: " . $conexion->error];
    } else {
        $checkStmt->bind_param("ii", $id_usuario, $id_casa);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            $response = ["success" => false, "message" => "El usuario ya ha marcado esta casa como 'Me gusta'."];
        } else {
            $sql = "INSERT INTO megusta (id_usuario, id_casa) VALUES (?, ?)";
            $stmt = $conexion->prepare($sql);

            if ($stmt === false) {
                $response = ["success" => false, "message" => "Error al preparar la declaración: " . $conexion->error];
            } else {
                $stmt->bind_param("ii", $id_usuario, $id_casa);

                if ($stmt->execute()) {
                    $response = ["success" => true, "message" => "'Me gusta' añadido correctamente."];
                } else {
                    $response = ["success" => false, "message" => "Error al insertar 'Me gusta': " . $stmt->error];
                }

                $stmt->close();
            }
        }

        $checkStmt->close();
    }
} else {
    $response = ["success" => false, "message" => "Datos insuficientes para la inserción."];
}

$conexion->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
