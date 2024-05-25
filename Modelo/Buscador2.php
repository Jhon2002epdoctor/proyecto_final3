<?php
include '../conexion.php';

$data = json_decode(file_get_contents('php://input'), true);

$query = "
    SELECT
        casa.*,
        imagenes.id_imagen,
        imagenes.imagen,
        imagenes.ocultoImagen
    FROM
        casa
    LEFT JOIN
        imagenes ON casa.id_casa = imagenes.id_casa
    WHERE
        casa.oculto = 0
";

// Aplicar los filtros si están presentes
$conditions = [];

if (isset($data['metros']) && !empty($data['metros'])) {
    $metros = intval($data['metros']);
    $conditions[] = "casa.metros = $metros";
}

if (isset($data['price']) && !empty($data['price'])) {
    $minPrice = intval($data['price']['min']);
    $maxPrice = intval($data['price']['max']);
    $conditions[] = "casa.precio BETWEEN $minPrice AND $maxPrice";
}

if (isset($data['rooms']) && !empty($data['rooms'])) {
    $rooms = intval($data['rooms']);
    $conditions[] = "casa.habitaciones = $rooms";
}

if (isset($data['houseType']) && !empty($data['houseType'])) {
    $houseType = $conexion->real_escape_string($data['houseType']);
    $conditions[] = "casa.titulo = '$houseType'";
}

if (!empty($conditions)) {
    $query .= ' AND ' . implode(' AND ', $conditions);
}

// Ejecutar la consulta
$result = $conexion->query($query);

$casas = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id_casa = $row['id_casa'];

        if (!isset($casas[$id_casa])) {
            $casas[$id_casa] = [
                'id' => $id_casa,
                'descprcion' => $row['descprcion'],
                'titulo' => $row['titulo'],
                'habitaciones' => $row['habitaciones'],
                'precio' => $row['precio'],
                'comunidad_autonoma' => $row['comunidad_autonoma'],
                'ciudad' => $row['ciudad'],
                'destacado' => $row['destacado'],
                'oculto' => $row['oculto'],
                'banos' => $row['banos'],
                'metros' => $row['metros'],
                'imagenes' => []
            ];
        }

        if ($row['id_imagen'] !== null) {
            $casas[$id_casa]['imagenes'][] = [
                'id_imagen' => $row['id_imagen'],
                'imagen' => $row['imagen'],
                'ocultoImagen' => $row['ocultoImagen']
            ];
        }
    }
}

$casas = array_values($casas);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

echo json_encode($casas);
?>
