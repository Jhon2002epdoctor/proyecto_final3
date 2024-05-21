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
           
           <div class="contenedor">
        <button class="boton-insertar">Insertar Casa</button>
        
        <input type="tel" name="" class="buscador" id="buscador" placeholder="Buscador">
        
        <div class="flex-center">
            <select id="filtro" class="filtro-select">
                <option value="id_busqueda">ID</option>
                <option value="precio">Precio</option>
                <option value="titulo">Título</option>
                <option value="comunidad">Comunidad</option>
                <option value="imagenes">Imágenes</option>
            </select>
        </div>
        
        <div id="contenedor-tarjetas" class="panel-contenedor">
            <div class="casa-panel">
                <div class="id-panel">
                    <p>ID</p>
                    <p>12</p>
                </div>
                <div class="precio-panel">
                    <p>Precio</p>
                    <p>0$</p>
                </div>
                <div class="titulo-panel">
                    <p>Título</p>
                    <p></p>
                </div>
                <div class="comunidad-panel">
                    <p>Comunidad Autónoma</p>
                    <p>Alicante</p>
                </div>
                <div class="img-panel">
                    <p>Imágenes</p>
                    <p>5</p>
                </div>
                <div class="botones">
                    <p>Botones</p>
                    <div class="boton">
                        <button class="modificar" data-id="12">Modificar</button>
                        <button class="eliminar" data-id="12" data-listener="true">Ocultar</button>
                        <button class="ver" id="toggleButton" data-id="12">Ver</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="paginacion"></div>
    </div>

    <div  class="chart-container" >
        <canvas id="myChart"></canvas>
    </div>
           

        </div>
   <?php include "../../components/footer.php" ?>
   <script type="module" src="../../js/panel_JS/panel.js"> </script>
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
