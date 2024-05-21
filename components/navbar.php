<?php 

session_start();  

$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : ''; 
?>

<header class="header">
    <nav class="nav">
        <div class="logo">
            <img src="/proyecto_final/img/logoSL.webp" alt="Logo">
        </div>
        <ul>
            <li><a href="/proyecto_final/index2.php">Inicio</a></li>
            <li><a href="/proyecto_final/Vista/login.php">Login</a></li>
            <li><a href="/proyecto_final/Vista/Conctato.php">Contacto</a></li>
            <li><a href="/proyecto_final/Vista/Buscador.php">Buscador</a></li>
            <?php if ($rol == "admin") { ?>
                <li><a href="/proyecto_final/Vista/Panel_control/panel.php">Panel de control</a></li>
            <?php } ?>
        </ul>
        <div class="menu_despegable">
            <i style="font-size: 24px" class="fa">&#xf0c9;</i>
            <ul class="menu_despegable_visible">
                <li><a href="/proyecto_final/index2.php">Inicio</a></li>
                <li><a href="/proyecto_final/Vista/login.php">Login</a></li>
                <li><a href="/proyecto_final/Vista/Conctato.php">Contacto</a></li>
                <li><a href="/proyecto_final/Vista/Buscador.php">Buscador</a></li>
                <?php if ($rol == "admin") { ?>
                    <li><a href="/proyecto_final/Vista/Panel_control/panel.php">Panel de control</a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="megusta">
            <?php if ($rol == "admin" || $rol == "normal") { ?>
                <a href="/proyecto_final/Vista/Megusta.php">
                    <i class="fa fa-heart corazones" style="font-size:24px;"></i>
                </a>
            <?php } else { ?>
                <i style="font-size: 24px" class="fa">&#xf004;</i>
            <?php } ?>
        </div>
    </nav>
</header>




