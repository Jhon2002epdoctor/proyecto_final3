<?php

include '../../conexion.php';

// Recibe el id_usuario desde una solicitud. Supongamos que se obtiene mediante POST.
$id_usuario =  isset($_GET["id"])? $_GET["id"] : 0;

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
    // Vincula el parámetro id_usuario a la consulta.
    $stmt->bind_param("i", $id_usuario);

    // Ejecuta la consulta.
    $stmt->execute();

    // Obtén el resultado.
    $result = $stmt->get_result();

    // Verifica si hay resultados.
    $casas = [];
    if ($result->num_rows > 0) {
        // Recorre los resultados.
        while ($row = $result->fetch_assoc()) {
            // Divide las imágenes en un arreglo.
            $imagenes = array_map(function ($imagen_str) {
                // Divide cada imagen en id_imagen, imagen (base64) y ocultoImagen.
                list($id_imagen, $imagen_base64, $oculto) = explode(':', $imagen_str);
                return [
                    'id_imagen' => (int) $id_imagen,
                    'imagen' => $imagen_base64,
                    'ocultoImagen' => (int) $oculto,
                ];
            }, explode(',', $row['imagenes']));

            // Agrega los datos de la casa al arreglo final.
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

    // Cierra la sentencia.
    $stmt->close();
} else {
    // Si la sentencia no se pudo preparar, maneja el error.
    $casas = [
        'error' => 'Error al preparar la consulta: ' . $conexion->error,
    ];
}

// Configura los encabezados de respuesta.
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Devuelve la información en formato JSON.
echo json_encode($casas);

?>
