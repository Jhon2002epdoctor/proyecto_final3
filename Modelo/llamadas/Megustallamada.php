<?php

include '../../conexion.php';

// Recibe el id_usuario desde una solicitud. Supongamos que se obtiene mediante POST.
  
$data = json_decode(file_get_contents("php://input"));

$id_usuario = $data->id_usuario ?? 0;

if($id_usuario == 0){
    echo json_encode(['error' => 'No se proporcionó un ID de usuario válido.']);
    exit;
}

$query = "
SELECT
    casa.id_casa,
    casa.descprcion,
    casa.habitaciones,
    casa.titulo,
    casa.precio,
    casa.comunidad_autonoma,
    casa.ciudad,
    casa.destacado,
    casa.oculto,
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

// Prepara la sentencia.
$stmt = $conexion->prepare($query);

if ($stmt) {
    $stmt->bind_param("i", $id_usuario);

    $stmt->execute();

    $result = $stmt->get_result();

    $casas = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
      
            $imagenes = array_map(function ($imagen_str) {
                
                list($id_imagen, $imagen_base64, $oculto) = explode(':', $imagen_str);
                return [
                    'id_imagen' => (int) $id_imagen,
                    'imagen' => $imagen_base64,
                    'ocultoImagen' => (int) $oculto,
                ];
            }, explode(',', $row['imagenes']));

          
            $casas[] = [
                'id_casa' => $row['id_casa'],
                'descprcion' => $row['descprcion'],
                'habitaciones' => $row['habitaciones'],
                'titulo' => $row['titulo'],
                'precio' => $row['precio'],
                'comunidad_autonoma' => $row['comunidad_autonoma'],
                'ciudad' => $row['ciudad'],
                'destacado' => (int) $row['destacado'],
                'oculto' => (int) $row['oculto'],
                'imagenes' => $imagenes,
            ];
        }
    }
    else{
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
