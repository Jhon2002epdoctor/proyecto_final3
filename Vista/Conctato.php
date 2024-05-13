<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../estilo.css">

    <link rel="stylesheet" href="styles.css">

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    height: 100vh;
    margin: 0;
}

.form-container {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 100%;
    max-width: 400px;
    text-align: center;
    margin: 50px auto;
}

h2 {
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
    text-align: left;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
input[type="email"],
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.submit{
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 15px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
}

button:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
     <?php  include "../components/navbar.php";  ?>
    <div class="form-container">
        <h2>Contáctanos</h2>
        <form action="https://formsubmit.co/solanomacascristofer@gmail.com" method="POST">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="subject">Asunto:</label>
                <input type="text" id="subject" name="asunto" required>
            </div>
            <div class="form-group">
                <label for="message">Mensaje:</label>
                <textarea id="message" name="mensaje" rows="5" required></textarea>
            </div>
             <input type="submit" class="submit" value="Enviar">
             <input type="hidden" name="_next" value="http://localhost/proyecto_final/index2.php">
             <input type="hidden"  name ="_captcha"  value="false">
             <input type="hidden" name="_subject" value="Nuevo mensaje de contacto">
             <input type="hidden" name="_template" value="box">
              <input type="hidden" name="_confirmation" value="Tu mensaje ha sido recibido, ¡gracias!">
        </form>
    </div>
    <?php  include "../components/footer.php";  ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
