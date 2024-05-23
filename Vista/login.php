<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../estilo.css">
    <link rel="stylesheet" href="../css/footer.css">
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
     

   <?php  include "../components/navbar.php"?>

<div class="contenedor">
  <div class="formulario">
         
        <form>
          <label for="" class="errorlogin"></label>
            <label class="validarUsuario"></label>
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="Usuario" required>

            <label class="validarContraseña"></label>
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contraseña" name="Contraseña" required autocomplete="password">

            <a href="registro.php">Crear una cuenta</a>

            <button type="submit"  class="login" id="submit">Iniciar</button>
        </form>
    </div>
  </div>  
 <?php include "../components/footer.php" ?>  
  <script type="module" src="../js/login.js"> </script>
</body>
</html>