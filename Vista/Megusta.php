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
    <link rel="stylesheet" href="../css/Megusta.css">

</head>
<body>

  <?php include "../components/navbar.php" ?>
   <h1 style="text-align: center;"  class="favoritos">Favoritos</h1>
  <div class="contenedor">
    <div class="panel-contenedor">
    </div>
  </div>
   
  <div id="paginacion">

  </div>

  <?php include "../components/footer.php" ?>

  <script type="module" src="../js/Megusta.js"></script>
</body>
</html>
