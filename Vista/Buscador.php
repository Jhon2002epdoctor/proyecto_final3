<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador con Método de Búsqueda</title>
    <link rel="stylesheet" href="/proyecto_final/css/navbar.css">
    <link rel="stylesheet" href="/proyecto_final/css/footer.css">
    <link rel="stylesheet" href="/proyecto_final/estilo.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/busacador.css">
</head>
<body>

  <?php include "../components/navbar.php" ?>
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

  <div class="contenedor">
     <div class="no_encontrado">
        
     </div>
    <div class="panel-contenedor">
      <!-- Aquí se agregarán dinámicamente las tarjetas de productos o resultados de búsqueda -->
      <div class="card">
        <div class="card-image-container">
          <!-- <img src="img/house-1836070_640.jpg" alt="Casa"> -->
        </div>
        <div class="icons-1 flex padding-top-10">
          <p class="precio">3000$</p>
          <i style="font-size: 18px" class="fa">&#xf06e;</i>
          <i style="font-size: 18px" class="fa">&#xf004;</i>
        </div>
        <div class="descripcion padding-top-10 padding-bottom-5">
          La Casa de tus sueños está aquí. La verdad es que es una gran oportunidad. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi quas nam voluptatem quia. Dolorem eius voluptatibus hic obcaecati aliquid eaque optio non. Illum odit eligendi temporibus fugiat corporis vitae soluta!
        </div>
        <div class="icons-2 flex padding-top-10">
          <i style="font-size: 18px" class="fa">&#xf236;</i> 1
          <i style="font-size: 18px" class="fa">&#xf2cc;"></i> 2
          <i style="font-size: 18px" class="fas">&#xf1ad;</i> 3
        </div>
        <div class="icons-3 flex padding-bottom-10 padding-top-10">
          <i style="font-size: 18px" class="fa">&#xf095;</i>
          <button class="boton3">Contactar</button>
        </div>
      </div>
      <div class="card">
        <div class="card-image-container">
          <!-- <img src="img/house-1836070_640.jpg" alt="Casa"> -->
        </div>
        <div class="icons-1 flex padding-top-10">
          <p class="precio">3000$</p>
          <i style="font-size: 18px" class="fa">&#xf06e;</i>
          <i style="font-size: 18px" class="fa">&#xf004;</i>
        </div>
        <div class="descripcion padding-top-10 padding-bottom-5">
          La Casa de tus sueños está aquí. La verdad es que es una gran oportunidad. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi quas nam voluptatem quia. Dolorem eius voluptatibus hic obcaecati aliquid eaque optio non. Illum odit eligendi temporibus fugiat corporis vitae soluta!
        </div>
        <div class="icons-2 flex padding-top-10">
          <i style="font-size: 18px" class="fa">&#xf236;</i> 1
          <i style="font-size: 18px" class="fa">&#xf2cc;"></i> 2
          <i style="font-size: 18px" class="fas">&#xf1ad;</i> 3
        </div>
        <div class="icons-3 flex padding-bottom-10 padding-top-10">
          <i style="font-size: 18px" class="fa">&#xf095;</i>
          <button class="boton3">Contactar</button>
        </div>
      </div>
      <div class="card">
        <div class="card-image-container">
          <!-- <img src="img/house-1836070_640.jpg" alt="Casa"> -->
        </div>
        <div class="icons-1 flex padding-top-10">
          <p class="precio">3000$</p>
          <i style="font-size: 18px" class="fa">&#xf06e;</i>
          <i style="font-size: 18px" class="fa">&#xf004;</i>
        </div>
        <div class="descripcion padding-top-10 padding-bottom-5">
          La Casa de tus sueños está aquí. La verdad es que es una gran oportunidad. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi quas nam voluptatem quia. Dolorem eius voluptatibus hic obcaecati aliquid eaque optio non. Illum odit eligendi temporibus fugiat corporis vitae soluta!
        </div>
        <div class="icons-2 flex padding-top-10">
          <i style="font-size: 18px" class="fa">&#xf236;</i> 1
          <i style="font-size: 18px" class="fa">&#xf2cc;"></i> 2
          <i style="font-size: 18px" class="fas">&#xf1ad;</i> 3
        </div>
        <div class="icons-3 flex padding-bottom-10 padding-top-10">
          <i style="font-size: 18px" class="fa">&#xf095;</i>
          <button class="boton3">Contactar</button>
        </div>
      </div>
      <div class="card">
        <div class="card-image-container">
          <!-- <img src="img/house-1836070_640.jpg" alt="Casa"> -->
        </div>
        <div class="icons-1 flex padding-top-10">
          <p class="precio">3000$</p>
          <i style="font-size: 18px" class="fa">&#xf06e;</i>
          <i style="font-size: 18px" class="fa">&#xf004;</i>
        </div>
        <div class="descripcion padding-top-10 padding-bottom-5">
          La Casa de tus sueños está aquí. La verdad es que es una gran oportunidad. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi quas nam voluptatem quia. Dolorem eius voluptatibus hic obcaecati aliquid eaque optio non. Illum odit eligendi temporibus fugiat corporis vitae soluta!
        </div>
        <div class="icons-2 flex padding-top-10">
          <i style="font-size: 18px" class="fa">&#xf236;</i> 1
          <i style="font-size: 18px" class="fa">&#xf2cc;"></i> 2
          <i style="font-size: 18px" class="fas">&#xf1ad;</i> 3
        </div>
        <div class="icons-3 flex padding-bottom-10 padding-top-10">
          <i style="font-size: 18px" class="fa">&#xf095;</i>
          <button class="boton3">Contactar</button>
        </div>
      </div>
      <!-- Se pueden duplicar las tarjetas según sea necesario -->
    </div>
  </div>
   
  <div id="paginacion">
    <!-- Aquí se agregarán los controles de paginación -->
  </div>

  <?php include "../components/footer.php" ?>

  <script type="module" src="../js/Buscador.js"></script>
</body>
</html>
