<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto</title>
    <link rel="stylesheet" href="/proyecto_final/css/navbar.css">
    <link rel="stylesheet" href="/proyecto_final/css/footer.css">
    <link rel="stylesheet" href="/proyecto_final/css/Conctato.css">
    <link rel="stylesheet" href="/proyecto_final/estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php include "../components/navbar.php"; ?>
    
    <div class="container mt-5">
        <h2>Contáctanos</h2>
        <form action="https://formsubmit.co/solanomacascristofer@gmail.com" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Asunto:</label>
                <input type="text" class="form-control" id="subject" name="asunto" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Mensaje:</label>
                <textarea class="form-control" id="message" name="mensaje" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary botonEnviar">Enviar</button>
            <input type="hidden" name="_next" value="http://localhost/proyecto_final/index.php">
            <input type="hidden" name="_captcha" value="false">
            <input type="hidden" name="_subject" value="Nuevo mensaje de contacto">
            <input type="hidden" name="_template" value="box">
            <input type="hidden" name="_confirmation" value="Tu mensaje ha sido recibido, ¡gracias!">
        </form>
    </div>

    <div class="container mt-5">
        <iframe class="w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3144.062746865769!2d-0.6983411234216539!3d37.99899687192962!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd63a9955dd0dcab%3A0x81c93dbd4dc88f96!2sSecondary%20School%20Torrevigia!5e0!3m2!1sen!2ses!4v1715709356140!5m2!1sen!2ses" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
<a href=""></a>
    <?php include "../components/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
      document.querySelector('.botonEnviar').addEventListener('click', function() {
        window.href.location = 'http://localhost/proyecto_final/index.php';
      });
    </script>
</body>
</html>
