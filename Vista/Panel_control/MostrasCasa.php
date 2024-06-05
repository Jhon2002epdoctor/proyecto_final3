<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="/proyecto_final/estilo.css">
    <link rel="stylesheet" href="/proyecto_final/css/navbar.css">
    <link rel="stylesheet" href="/proyecto_final/css/footer.css">
    <link rel="stylesheet" href="/proyecto_final/css/Mostrarcasa.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
</head>
<body>
<?php 

ob_start();

include "../../components/navbar.php" 
?>
<?php 
  if(!isset($_SESSION['rol'])){
    header('Location: /proyecto_final/index.php');

    exit();
  } else if($_SESSION['rol'] != "admin") {
    header('Location: /proyecto_final/index.php');

    exit();
  }
  ob_end_flush();
?>
    <div class="container">
       <div class="informacion">
       </div>
                <section class="carrusel"   id="carrusel">
                    <div class="titulo-carrusel">
                        <h2>Casa</h2>
                    </div>
                    <svg id="btnback" class="atras"  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                    </svg>
                    <section class="carrusel-container">
                    </section>
                    <svg id="btnNext" class="adelante"  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                    <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                    </svg>
                </section>
                <section  class="icons-casa">
                        
                </section>
                <section class="descripcion">
                    <h2>Descripción</h2>
                      <p class="texto-descripcion">
                         Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut rerum dolor repellat nihil, consequuntur asperiores illum voluptatem corrupti quod at assumenda sunt perferendis alias deleniti aperiam ratione minima repellendus cum.
                         Lorem ipsum dolor sit amet consectetur adipisicing elit. Error inventore doloremque, expedita eius mollitia nemo. Quisquam, expedita? Adipisci nesciunt explicabo doloremque. Eius quis, nesciunt libero eaque vel iste cum repellendus?
                         Molestiae aspernatur rerum quas consectetur necessitatibus dolor esse ad debitis impedit cupiditate et porro dicta ut placeat, dolorem quos, nihil illo a iure soluta consequatur quaerat id dignissimos illum. Voluptatibus.
                         Excepturi sed nisi animi delectus sunt laborum facilis modi, ad repellendus quis ipsam quo nesciunt cum eligendi pariatur voluptates unde distinctio eveniet quam. Autem necessitatibus error eligendi quaerat magnam sit.
                         Nesciunt assumenda laboriosam quod totam voluptas ullam ipsum voluptate sunt dicta, commodi magnam beatae repudiandae a exercitationem! Nesciunt velit sed consequatur quis hic unde, incidunt eligendi, sequi dolore facilis qui.
                      </p>
                </section>
    </div>

<?php include "../../components/footer.php" ?>

<script src="../../js/panel_JS/Mostrarcasa.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>