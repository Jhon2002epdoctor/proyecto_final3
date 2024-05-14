<?php
include '../conexion.php';

$data = json_decode(file_get_contents("php://input"));

$metodoBusqueda = $data->metodoBusqueda ?? '';
$valorBuscador = $data->valorBuscador ?? '';

$query = '';
$params = [];

switch ($metodoBusqueda) {
    case 'precio':
        $query = "
            SELECT
                casa.*,
                GROUP_CONCAT(CONCAT(imagenes.id_imagen, ':', imagenes.imagen, ':', imagenes.ocultoImagen) SEPARATOR ',') AS imagenes
            FROM
                casa
            JOIN
                imagenes ON casa.id_casa = imagenes.id_casa
            WHERE
                casa.oculto = 0 AND casa.precio = ?
            GROUP BY
                casa.id_casa
        ";
        $params = ["d", $valorBuscador];
        break;
    
    case 'titulo':
        $query = "
            SELECT
                casa.*,
                GROUP_CONCAT(CONCAT(imagenes.id_imagen, ':', imagenes.imagen, ':', imagenes.ocultoImagen) SEPARATOR ',') AS imagenes
            FROM
                casa
            JOIN
                imagenes ON casa.id_casa = imagenes.id_casa
            WHERE
                casa.oculto = 0 AND casa.titulo LIKE ?
            GROUP BY
                casa.id_casa
        ";
        $params = ["s", "%{$valorBuscador}%"];
        break;
    
    case 'todos':
        $query = "
            SELECT
                casa.*,
                GROUP_CONCAT(CONCAT(imagenes.id_imagen, ':', imagenes.imagen, ':', imagenes.ocultoImagen) SEPARATOR ',') AS imagenes
            FROM
                casa
            JOIN
                imagenes ON casa.id_casa = imagenes.id_casa
            WHERE
                casa.oculto = 0
            GROUP BY
                casa.id_casa
        ";
        break;
    
    default:
        echo json_encode(['message' => 'No se encontraron casas.']);
        exit;
}

$stmt = $conexion->prepare($query);
if (!$stmt) {
    echo json_encode(['message' => 'No se encontraron casas.']);
    exit;
}

if (!empty($params)) {
    $stmt->bind_param($params[0], $params[1]);
}
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
        $casas[] = array_merge($row, ['imagenes' => $imagenes]);
    }
} else {
    $casas = ['message' => 'No se encontraron casas.'];
}

$stmt->close();
$conexion->close();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
echo json_encode($casas);
?>
