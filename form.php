<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <style>
      body {
    font-family: Arial, sans-serif;
    margin: 20px;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }
  form {
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
  }
  .form-group {
    margin-bottom: 10px;
  }
  label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
  }
  input[type="text"],
  textarea,
  input[type="file"] , input[type="number"] {
    width: 100%; 
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  button {
    background-color: #007BFF;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  button:hover {
    background-color: #0056b3;
  }
     </style>
</head>
<body>
<form action="prueba.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="titulo">Titulo:</label>
        <input type="text" id="titulo" name="titulo" required>
      </div>
      <div class="form-group">
        <label for="habitaciones">Habitaciones:</label>
        <input type="number" id="habitaciones" name="habitaciones" required>
      </div>
      <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
      </div>
      <div class="form-group">
        <label for="imagenes">Subir Imagen:</label>
        <input type="file" name="imagenes[]" multiple="multiple">
      </div>
      <button type="submit">Enviar</button>

    

</form>    

</body>
</html>