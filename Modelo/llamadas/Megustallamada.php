<?php

include '../../conexion.php';
  
$data = json_decode(file_get_contents("php://input"));

$id_usuario = $data->id_usuario ?? 0;

if($id_usuario == 0){
    echo json_encode(['error' => 'No se proporcionó un ID de usuario válido.']);
    exit;
}

$query = "
SELECT
    casa.*,
    GROUP_CONCAT(CONCAT(imagenes.id_imagen, ':', imagenes.imagen, ':', imagenes.ocultoImagen) SEPARATOR ',') AS imagenes
FROM
    casa
JOIN
    imagenes ON casa.id_casa = imagenes.id_casa
JOIN
    megusta ON casa.id_casa = megusta.id_casa
WHERE
    megusta.id_usuario = ?
GROUP BY
    casa.id_casa;
";

$stmt = $conexion->prepare($query);

if ($stmt) {
    $stmt->bind_param("i", $id_usuario);

    $stmt->execute();

    $result = $stmt->get_result();

    $casas = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
      
            $imagenes = array_map(function ($imagen_str) {
                $parts = explode(':', $imagen_str);
                
                if (count($parts) === 3) {
                    list($id_imagen, $imagen_base64, $oculto) = $parts;
                    return [
                        'id_imagen' => (int) $id_imagen,
                        'imagen' => $imagen_base64,
                        'ocultoImagen' => (int) $oculto,
                    ];
                } else {
                    return null; 
                }
            }, explode(',', $row['imagenes']));

            $imagenes = array_filter($imagenes);

            $casas[] = [
                'id' => $row['id_casa'],
                'descprcion' => $row['descprcion'],
                'habitaciones' => $row['habitaciones'],
                'titulo' => $row['titulo'],
                'precio' => $row['precio'],
                'comunidad_autonoma' => $row['comunidad_autonoma'],
                'ciudad' => $row['ciudad'],
                'destacado' => (int) $row['destacado'],
                'oculto' => (int) $row['oculto'],
                'banos' => $row['banos'],
                'metros' => $row['metros'],
                'imagenes' => $imagenes,
            ];
        }
    } else {
        $casas = [
            'message' => 'No se encontraron casas.',
        ];
    }

    $stmt->close();
} else {
   
    $casas = [
        'message' => 'Error al preparar la consulta: ' . $conexion->error,
    ];
}

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

echo json_encode($casas);

?>
