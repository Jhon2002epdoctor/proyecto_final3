<?php 

include '../../conexion.php';


$idCasa = isset($_GET['id']) ? intval($_GET['id']) : 0; 

if ($idCasa > 0) {
    $query = "SELECT casa.*, GROUP_CONCAT(imagenes.imagen) as imagenes 
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
            $casas[] = [
                'imagenes' => explode(',', $row['imagenes']),
                'descprcion' => $row['descprcion'],
                'titulo' => $row['titulo'],
                'habitaciones' => $row['habitaciones'],
                'id' => $row['id_casa'],
                'precio' => $row['precio'],
                'ciudad' => $row['ciudad'],
                'comunidad_autonoma' => $row['comunidad_autonoma'],
                'destacado' => $row['destacado'],
                'banos' => $row['banos'],
                'metros' => $row['metros'],

            ];
        }
    }
    $stmt->close();
} else {
    $casas = ['error' => 'No se proporcionó un ID válido.'];
}

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
echo json_encode($casas);

  


?>