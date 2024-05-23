<?php

include '../../conexion.php';


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
        casa.destacado = 1 AND casa.oculto = 0
";


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
