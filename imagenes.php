<?php 
include 'conexion.php';

$query = "SELECT imagen FROM imagenes";
$result = $conexion->query($query);

$imagenes = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $imagenes[] = $row['imagen'];
    }
} else {
    echo "No se encontraron imágenes.";
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualización de Imágenes</title>
</head>
<body>
    <h1>Imágenes desde la Base de Datos</h1>
    <?php foreach ($imagenes as $imagenBase64): ?>
        <img src="data:image/jpeg;base64,<?php echo $imagenBase64; ?>" alt="Imagen" style="max-width: 100%; height: auto;">
    <?php endforeach; ?>
</body>
</html>