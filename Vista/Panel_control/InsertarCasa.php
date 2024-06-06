<?php 
require("../../config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Propiedad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/estilo.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/navbar.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/footer.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/Mostrarcasa.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/Panelcss/InsertarCasa.css">
</head>
<body>
<?php 
ob_start();
include "../../components/navbar.php" 
?>
<?php 
  if(!isset($_SESSION['rol'])){
    header('Location: <?php echo BASE_URL?>/index.php');
    exit();
  } else if($_SESSION['rol'] != "admin") {
    header('Location: <?php echo BASE_URL?>/index.php');
    exit();
  }
  ob_end_flush();
?>
<div class="contenedor">
    <h2>Insertar Inmueble</h2>
    <form id="propertyForm" enctype="multipart/form-data">
        <label class="validardescripcion"></label>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" rows="4" name="descripcion" placeholder="Ingresa una descripción"></textarea> 
    
        <label class="validarhabitaciones"></label>
        <label for="habitaciones">Habitaciones:</label>
        <input type="number" id="habitaciones" name="habitaciones" placeholder="Cantidad de habitaciones">

        <label class="validarprecio"></label>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" placeholder="Precio en USD">

        <label class="validarmetros"></label>
        <label for="metros">Metros cuadrados:</label>
        <input type="number" id="metros" name="metros" placeholder="Metros cuadrados de la casa"> 

        <label class="validarbanos"></label>
        <label for="banos">Baños:</label>
        <input type="number" id="banos" name="banos" placeholder="Introduce los baños"> 

        <label class="validarcomunidad"></label>
        <label for="comunidad">Comunidad:</label>
        <input type="text" id="comunidad" name="comunidad" placeholder="Nombre de la comunidad">

        <label class="validarciudad"></label>
        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" placeholder="Nombre de la ciudad">

        <label for="tipo">Tipo de Propiedad:</label>
        <select id="tipo" name="tipo">
            <option value="Piso">Piso</option>
            <option value="Chalet">Chalet</option>
            <option value="Mansion">Mansión</option>
            <option value="Apartamento">Apartamento</option>
            <option value="Duplex">Dúplex</option>
            <option value="Estudio">Estudio</option>
        </select>

        <label class="validardestacado"></label>
        <label for="destacado">Propiedad Destacada:</label>
        <input type="checkbox" id="destacado" name="destacado"> Marcar como destacado

        <label class="validaroculto"></label>
        <label for="oculto">Oculto:</label>
        <input type="checkbox" id="oculto" name="oculto"> Marcar como oculto

        <label class="validarimagenes"></label>
        <label for="imagenes">Agregar más imágenes:</label>
        <input type="file" id="imagenes" name="imagenes[]" multiple>

        <button type="submit" class="boton3" id="modificarBtn">Modificar</button>
    </form>
</div>

<?php include "../../components/footer.php" ?>

<script type="module" src="../../js/panel_JS/InsertarCasa.js"></script>
</body>
</html>
