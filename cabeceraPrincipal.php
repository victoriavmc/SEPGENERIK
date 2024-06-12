<?php
include './head.php';
date_default_timezone_set('America/Argentina/Buenos_Aires');
setlocale(LC_TIME, "es");

$rol = $_SESSION['rol'] ?? '';
$login = $_SESSION['login'] ?? '';
$auth = false;

if ($rol === "Administrador" and $login) {
    $auth = true;
}

$fecha = ucfirst(strftime("%A")) . " " . strftime("%d") . " de " . ucfirst(strftime("%B")) . " de " . strftime("%Y");

?>
<header class="barra-superior">
    <div class="barra">
        <div class="titulo">
            <h1 class="titulo-header">SEP Generik - <span class="fecha-header"><?php echo $fecha; ?></span></h1>
        </div>
        <?php if ($auth) { ?>
            <div class="fondo-historial">
                <a class="link-historial" href="./verHistorial.php"><img class="imagen-historial" src="./Style/Images/historial-sinbg.png" alt=""></a>
            </div>
        <?php } ?>
        <img class="logo" src="/Style/Images/logoGenerik.png" alt="logito">
    </div>
</header>