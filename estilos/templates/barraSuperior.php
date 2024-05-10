<?php
setlocale(LC_TIME, "ES");
$fecha = ucfirst(strftime("%A")) . " " . strftime("%d") . " de " . ucfirst(strftime("%B")) . " de " . strftime("%Y");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bitter:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./estilos/css/style.css">
    <title>SEP Generik</title>
    <link rel="icon" href="estilos/icono/logoG.ico" />
</head>

<body>
    <header class="barra-superior">
        <div class="barra">
            <div class="titulo">
                <h1 class="titulo-header">SEP Generik - <span class="fecha-header"> <?php echo $fecha ?> <span></h1>
            </div>
            <img class="logo" src="estilos/img/logoGenerik.png" alt="">
        </div>
    </header>