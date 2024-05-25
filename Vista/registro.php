<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/proyecto_final/css/registro.css">
    <link rel="stylesheet" href="/proyecto_final/css/navbar.css">
    <link rel="stylesheet" href="/proyecto_final/css/footer.css">
    <link rel="stylesheet" href="/proyecto_final/estilo.css">
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
   <?php  include "../components/navbar.php" ?>

<div class="contenedor">
      <div class="formulario">
            <form action="../Modelo/registroInsert" method="post">
                <label for="" class="usuario"></label>
                <label class="validarNombre" ></label>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="Nombre" required>

                <label class="validarUsuario"></label>
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="Usuario" required>

                <label class="validarEmail"></label>
                <label for="email">Email:</label>
                <input type="email" id="email" name="Email" required>

                <label class="validarContrasena"></label>
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="Contrasena" required>

                <button type="submit" class="enviar">Registrar</button>
            </form>
        </div>
</div>  

  <?php include "../components/footer.php" ?>
</body>
 <script type="module" src="../js/registro.js"> </script>
</html>