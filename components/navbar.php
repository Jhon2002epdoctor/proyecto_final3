<?php 
session_start();  
// require_once dirname(__DIR__) . '/config.php';

$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : ''; 
?>

<header class="header">
    <nav class="nav">
        <div class="logo">
            <img src="<?php echo BASE_URL?>/img/logoSL.webp" alt="Logo">
        </div>
        <ul>
            <li><a href="<?php echo BASE_URL?>/index.php">Inicio</a></li>
            <li><a href="<?php echo BASE_URL?>/Vista/Buscador.php">Buscador</a></li>
            <li><a href="<?php echo BASE_URL?>/Vista/Conctato.php">Contacto</a></li>
            <li><a href="<?php echo BASE_URL?>/Vista/QuienesSomos.php">Quines somos</a></li>
            <?php if ($rol == "admin") { ?>
                <li><a href="<?php echo BASE_URL?>/Vista/Panel_control/panel.php">Panel de control</a></li>
            <?php } ?>
        </ul>
        <div class="menu_despegable">
            <i style="font-size: 24px" class="fa">&#xf0c9;</i>
            <ul class="menu_despegable_visible">
                <?php if ($rol == "admin" || $rol == "normal") { ?>
                    <li> <a href="<?php echo BASE_URL?>/Vista/Megusta.php"><i class="fa fa-heart"></i> Favoritos</a></li>
                     <li><a href="" id="salir" ><i class="fa fa-sign-out"></i> Salir</a> </li>       
                <?php } else {  ?>
                           <li> <a href="<?php echo BASE_URL?>/Vista/login.php?logout=true">Iniciar Sesion</a></li>
               <?php } ?>
                <li><a href="<?php echo BASE_URL?>/index.php">Inicio</a></li>
                <li><a href="<?php echo BASE_URL?>/Vista/Buscador.php">Buscador</a></li>
                <li><a href="<?php echo BASE_URL?>/Vista/Conctato.php">Contacto</a></li>
                <li><a href="<?php echo BASE_URL?>/Vista/QuienesSomos.php">Quines somos</a></li>
                <?php if ($rol == "admin") { ?>
                    <li><a href="<?php echo BASE_URL?>/Vista/Panel_control/panel.php">Panel de control</a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="megusta">
                 
              <?php if ($rol == "admin" || $rol == "normal") { ?>
                <div class="dropdown">
                    <i class="fa fa-user-circle dropdown-toggle" style="font-size:24px"></i>
                    <div class="dropdown-menu">
                        <a href="<?php echo BASE_URL?>/Vista/Megusta.php"><i class="fa fa-heart"></i> Favoritos</a>
                        <li><a href="" id="salir" ><i class="fa fa-sign-out"></i> Salir</a> </li>       
                    </div>
                </div>
            <?php } else { ?>
                <div class="dropdown">
                    <i class="fa fa-user-circle dropdown-toggle" style="font-size:24px"></i>
                    <div class="dropdown-menu">
                        <a href="<?php echo BASE_URL?>/Vista/login.php?logout=true"><i class="fa fa-sign-out"></i>Iniciar Sesion</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </nav>
</header>
<script  type="module" src="<?php echo BASE_URL?>/js/navbar.js" > </script>

