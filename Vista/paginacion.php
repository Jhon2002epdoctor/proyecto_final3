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
        }

        .contenedor-tarjetas {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }

        .tarjeta {
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 200px;
            text-align: center;
            background-color: #fff;
            transition: box-shadow 0.2s;
        }

        .tarjeta:hover {
            box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.2);
        }

        .tarjeta h3 {
            margin: 0;
            color: #333;
        }

        .tarjeta p {
            margin: 10px 0;
            color: #777;
        }

        #paginacion {
            text-align: center;
            margin-top: 20px;
        }

        #paginacion button {
            margin: 5px;
            padding: 8px 12px;
            border: 1px solid #007bff;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        #paginacion button:hover {
            background-color: #0056b3;
        }

        #paginacion button.active {
            background-color: #0056b3;
            cursor: default;
        }

    </style>
</head>
<body>
<div id="contenedor-tarjetas" class="contenedor-tarjetas"></div>
    <div id="paginacion"></div>

    <script src="../js/paginacion.js"></script>
</body>
</html>