<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/Panelcss/panel.css">
    <link rel="stylesheet" href="../../css/navbar.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../estilo.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <title>Document</title>
</head>
<body>

      
 <?php include "../../components/navbar.php" ?>
         
 <?php 

if(!isset($_SESSION['rol'])){
      header('Location: ../../index2.php');
 }
if(isset($_SESSION['rol'])){
    if($_SESSION['rol'] != "admin"){
      header('Location: ../../index2.php');
    }
}
?>
           
             <div> 
                 <button class="boton-insertar">Insertar Casa</button>
             </div>
        <div class="contenedor">
                  <input type="tel" name="" class="buscador" id="buscador" placeholder="Buscador">
                  <div class="filtro">
                       <div class="flex-center">
                          <p>id</p>
                          <input type="radio" name="buscar" value="id_busqueda" id="id_busqueda" checked >
                       </div>
                       <div class="flex-center">
                          <p>precio</p>
                          <input type="radio" name="buscar" value="precio" id="">
                       </div>
                       <div class="flex-center">
                          <p>titulo</p>
                          <input type="radio" name="buscar"  value="titulo" id="">
                       </div>
                       <div class="flex-center">
                          <p>comunidad</p>
                          <input type="radio" name="buscar" value="comunidad" id="">
                       </div>
                       <div class="flex-center">
                          <p>imagenes</p>
                          <input type="radio" name="buscar" value="imagenes" id="">
                       </div>
                  </div> 
                <div id="contenedor-tarjetas" class="panel-contenedor">
                         
                </div>
                <div id="paginacion"></div>
        
        </div>
    <script src="../../js/panel_JS/panel.js"> </script>
   <?php include "../../components/footer.php" ?>
</body>
</html>
