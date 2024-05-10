<?php

function conectarBD()
{
    $bd = mysqli_connect('XAMPP', 'root', '', 'sepgenerik-er');

    if (!$bd) {
        die('No se pudo conectar a la base de datos');
    }
    return $bd;
}
