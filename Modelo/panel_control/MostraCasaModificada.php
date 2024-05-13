<?php

include '../../conexion.php';

$idCasa = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($idCasa > 0) {
  

    $query = "SELECT 
    casa.*, 
    GROUP_CONCAT(CONCAT(imagenes.id_imagen, ':', imagenes.imagen, ':' , imagenes.ocultoImagen) SEPARATOR ',') AS imagenes
    FROM casa
    JOIN imagenes ON casa.id_casa = imagenes.id_casa
    WHERE casa.id_casa = ?
    GROUP BY casa.id_casa";


    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $idCasa);
    $stmt->execute();
    $result = $stmt->get_result();

    $casas = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
       
            $imagenes = [];
            $imagenesPares = explode(',', $row['imagenes']);
            foreach ($imagenesPares as $imagenPar) {
                list($idImagen, $imagen , $oculto) = explode(':', $imagenPar);
                $imagenes[] = ['id' => intval($idImagen), 'imagen' => $imagen , 'oculto' => $oculto];
            }

            $casas[] = [
                'id' => $row['id_casa'],
                'descripcion' => $row['descprcion'],
                'titulo' => $row['titulo'],
                'habitaciones' => $row['habitaciones'],
                'precio' => $row['precio'],
                'ciudad' => $row['ciudad'],
                'comunidad_autonoma' => $row['comunidad_autonoma'],
                'destacado' => $row['destacado'],
                'imagenes' => $imagenes,
                'oculto' => $row['oculto']
            ];
        }
    }
    $stmt->close();
} else {
    $casas = ['error' => 'No se proporcionó un ID válido.'];
}

$result = isset($casas[0]["titulo"])? $casas:array(); 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
echo json_encode($result);

?>
