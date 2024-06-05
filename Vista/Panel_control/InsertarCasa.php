<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Propiedad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/proyecto_final/estilo.css">
    <link rel="stylesheet" href="/proyecto_final/css/navbar.css">
    <link rel="stylesheet" href="/proyecto_final/css/footer.css">
    <link rel="stylesheet" href="/proyecto_final/css/Mostrarcasa.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/proyecto_final/css/Panelcss/InsertarCasa.css">
</head>
<body>
   

<?php 

ob_start();

include "../../components/navbar.php" 
?>
<?php 
  if(!isset($_SESSION['rol'])){
    header('Location: /proyecto_final/index2.php');

    exit();
  } else if($_SESSION['rol'] != "admin") {
    header('Location: /proyecto_final/index2.php');

    exit();
  }
  ob_end_flush();
?>
<div class="contenedor">
    <h2>Insertar Inmueble</h2>
    <form id="propertyForm">

        <label class="validarDescripcion"></label>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" rows="4" name="Descripcion" placeholder="Ingresa una descripción"></textarea> 
    
        <label class="validarHabitaciones"></label>
        <label for="habitaciones">Habitaciones:</label>
        <input type="number" id="habitaciones" name="Habitaciones" placeholder="Cantidad de habitaciones">

        <label class="validarPrecio"></label>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="Precio" placeholder="Precio en USD">

        <label class="validarMetros"></label>
        <label for="metros">Metros cuadrados:</label>
        <input type="number" id="metros" name="Metros" placeholder="Metros cuadrados de la casa"> 

        <label class="validarBaños"></label>
        <label for="metros">Baños:</label>
        <input type="number" id="banos" name="Baños" placeholder="Introduce los banos"> 


        <label class="validarComunidad"></label>
        <label for="comunidad">Comunidad:</label>
        <input type="text" id="comunidad" name="Comunidad" placeholder="Nombre de la comunidad">

        <label class="validarCiudad"></label>
        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="Ciudad" placeholder="Nombre de la ciudad">

        <label for="tipo">Tipo de Propiedad:</label>
        <select id="tipo" name="Tipo">
            <option value="Piso">Piso</option>
            <option value="Chalet">Chalet</option>
            <option value="Mansion">Mansión</option>
            <option value="Apartamento">Apartamento</option>
            <option value="Duplex">Dúplex</option>
            <option value="Estudio">Estudio</option>
        </select>



        <label class="validarDestacado"></label>
        <label for="destacado">Propiedad Destacada:</label>
        <input type="checkbox" id="destacado"  name="Destacado"> Marcar como destacado

        <label class="validarOculto"></label>
        <label for="oculto">Oculto:</label>
        <input type="checkbox" id="oculto" name="Oculto"> Marcar como oculto

        <label class="validarImagenes"></label>
        <label for="imagenes">Agregar más imágenes:</label>
        <input type="file" id="imagenes" name="Imagenes" multiple>

        <button type="submit" class="boton3" id="modificarBtn">Modificar</button>
    </form>
</div>

<?php include "../../components/footer.php" ?>

<script type="module" src="../../js/panel_JS/InsertarCasa.js"></script>
</body>
</html>
