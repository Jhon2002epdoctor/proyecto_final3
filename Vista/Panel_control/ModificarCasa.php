<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="/proyecto_final/estilo.css">
    <link rel="stylesheet" href="/proyecto_final/css/navbar.css">
    <link rel="stylesheet" href="/proyecto_final/css/footer.css">
    <link rel="stylesheet" href="/proyecto_final/css/Mostrarcasa.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    /> 
    <link rel="stylesheet" href="/proyecto_final/css/PanelCss/ModificarCasa.css">
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
    <h2>Modificar Propiedades</h2>     
        <label class="validarDescripcion"></label>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" rows="4" name="Descripcion" placeholder="Ingresa una descripción"></textarea> 
    
        <label class="validarHabitaciones"></label>
        <label for="habitaciones">Habitaciones:</label>
        <input type="number" id="habitaciones" name="Habitaciones" placeholder="Cantidad de habitaciones">

        <label class="validarPrecio"></label>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="Precio" placeholder="Precio en USD">

        <label class="validarComunidad"></label>
        <label for="comunidad">Comunidad:</label>
        <input type="text" id="comunidad" name="Comunidad" placeholder="Nombre de la comunidad">

        <label class="validarCiudad"></label>
        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="Ciudad" placeholder="Nombre de la ciudad">

        <label for="tipo">Tipo de Propiedad:</label>
        <select id="tipo" name="Tipo">
            <option value="piso">Piso</option>
            <option value="chalet">Chalet</option>
            <option value="mansion">Mansión</option>
            <option value="apartamento">Apartamento</option>
            <option value="duplex">Dúplex</option>
            <option value="estudio">Estudio</option>
        </select>


        <label class="validarDestacado"></label>
        <label for="destacado">Propiedad Destacada:</label>
        <input type="checkbox" id="destacado"  name="Destacado" > Marcar como destacado 

         <label class="validarOculto"></label>
        <label for="oculto">Oculto:</label>
        <input type="checkbox" id="oculto" name="Oculto"> Marcar como oculto


    <div class="imagenes-modificar">
     
    </div>
<!-- 
    <label for="">Ocultar 
    <input type="checkbox" name="eliminar[]" checked value="${img.id}"> 
    </label> -->

        <label class="validarImagenes"></label>
        <label for="imagenes">Agregar más imágenes:</label>
        <input type="file" id="imagenes" class="imagenes" name="Imagenes" multiple >

    <button class="boton3  Modificartotalmente">Modificar</button>
</div>

        <?php include "../../components/footer.php" ?>       


         <script type="module" src="../../js/panel_JS/modificar.js"></script>     
</body>
</html>