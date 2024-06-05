<?php 
require("../../config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/Panelcss/panel.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/navbar.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/footer.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/estilo.css">
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

      
<?php 

ob_start();

include "../../components/navbar.php" 
?>
<?php 
  if(!isset($_SESSION['rol'])){
    header('Location:' .BASE_URL.'/index.php');
    exit();
  } else if($_SESSION['rol'] != "admin") {
    header('Location:' .BASE_URL.'/index.php');
    exit();
  }
  ob_end_flush();
?>
           
    <form id="filterForm">
        <div class="filter-group">
            <input type="checkbox" id="metrosCheckbox" name="metros">
            <label for="metrosCheckbox">Filtrar por metros</label>
            <input type="number" id="metros" name="metros" placeholder="Metros cuadrados" class="filter-input">
        </div>
        <div class="filter-group">
            <input type="checkbox" id="priceCheckbox" name="price">
            <label for="priceCheckbox">Filtrar por precio</label>
            <input type="number" id="minPrice" name="minPrice" placeholder="Precio mínimo" class="filter-input">
            <input type="number" id="maxPrice" name="maxPrice" placeholder="Precio máximo" class="filter-input">
        </div>
        <div class="filter-group">
            <input type="checkbox" id="roomsCheckbox" name="rooms">
            <label for="roomsCheckbox">Filtrar por habitaciones</label>
            <input type="number" id="rooms" name="rooms" placeholder="Número de habitaciones" class="filter-input">
        </div>
        <div class="filter-group">
            <input type="checkbox" id="typeCheckbox" name="type">
            <label for="typeCheckbox">Tipo de casa</label>
            <select name="houseType" id="houseType" class="filter-input">
                <option value="Mansion">Mansión</option>
                <option value="Duplex">Duplex</option>
                <option value="Piso">Piso</option>
                <option value="Apartamento">Apartamento</option>
                <option value="Chalet">Chalet</option>
                <option value="Atico">Ático</option>
                <option value="Estudio">Estudio</option>
            </select>
        </div>
        <button type="button" id="buscar">Aplicar filtros</button>
    </form>
    <div class="no_encontrado">
        
    </div>
    <div class="contenedor">
     <button class="boton-insertar">Insertar Casa</button>    
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
