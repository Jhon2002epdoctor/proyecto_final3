<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Propiedad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../estilo.css">
    <link rel="stylesheet" href="../../css/navbar.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/Mostrarcasa.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .contenedor {
            margin: 40px auto;
            max-width: 800px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: all 0.3s ease;
        }
        .contenedor h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"], input[type="number"], textarea, select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        input[type="text"]:focus, input[type="number"]:focus, textarea:focus, select:focus {
            border-color: #007BFF;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.1);
        }
        .boton3 {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            align-self: center;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .boton3:hover {
            background-color: #0056b3;
        }
        .imagenes-modificar, .imagen-modificar {
            margin-bottom: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 10px;
        }
        .imagen-modificar img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            margin-bottom: 10px;
            border-radius: 8px;
        }
        @media (max-width: 768px) {
            .contenedor {
                margin: 20px;
                padding: 15px;
            }
            input[type="text"], input[type="number"], textarea, select {
                padding: 10px;
                font-size: 14px;
            }
            .boton3 {
                padding: 8px 16px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
<?php include "../../components/navbar.php" ?>
<?php 
  if(!isset($_SESSION['rol'])){
    header('Location: ../../index2.php');
  } elseif($_SESSION['rol'] != "admin") {
    header('Location: ../../index2.php');
  }
?>
<div class="contenedor">
    <h2>Modificar Propiedad</h2>
    <form id="propertyForm">

        <label class="validarDescripcion"></label>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" rows="4" name="Descripcion" placeholder="Ingresa una descripción"></textarea> 
    
        <label class="validarHabitaciones"></label>
        <label for="habitaciones">Habitaciones:</label>
        <input type="number" id="habitaciones" name="Habitaciones" placeholder="Cantidad de habitaciones">

        <label class="validarTitulo"></label>
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="Titulo" placeholder="Titulo">

        <label class="validarPrecio"></label>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="Precio" placeholder="Precio en USD">

        <label class="validarMetros"></label>
        <label for="metros">Metros cuadrados:</label>
        <input type="number" id="metros" name="Metros" placeholder="Metros cuadrados de la casa"> 

        <label class="validarBaños"></label>
        <label for="metros">Baños:</label>
        <input type="number" id="banos" name="Baños" placeholder="Introduce los banos"> 


        <label class="validarComunidad"></label>
        <label for="comunidad">Comunidad:</label>
        <input type="text" id="comunidad" name="Comunidad" placeholder="Nombre de la comunidad">

        <label class="validarCiudad"></label>
        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="Ciudad" placeholder="Nombre de la ciudad">

        <label for="tipo">Tipo de Propiedad:</label>
        <select id="tipo" name="Tipo">
            <option value="piso">Piso</option>
            <option value="chalet">Chalet</option>
            <option value="mansion">Mansión</option>
            <option value="apartamento">Apartamento</option>
            <option value="duplex">Dúplex</option>
            <option value="estudio">Estudio</option>
        </select>



        <label class="validarDestacado"></label>
        <label for="destacado">Propiedad Destacada:</label>
        <input type="checkbox" id="destacado"  name="Destacado"> Marcar como destacado

        <label class="validarOculto"></label>
        <label for="oculto">Oculto:</label>
        <input type="checkbox" id="oculto" name="Oculto"> Marcar como oculto

        <label class="validarImagenes"></label>
        <label for="imagenes">Agregar más imágenes:</label>
        <input type="file" id="imagenes" name="Imagenes" multiple>

        <button type="submit" class="boton3" id="modificarBtn">Modificar</button>
    </form>
</div>

<?php include "../../components/footer.php" ?>

<script type="module" src="../../js/panel_JS/InsertarCasa.js"></script>
</body>
</html>
