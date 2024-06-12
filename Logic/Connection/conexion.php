<?php
function conexionBaseDatos()
{
    $Bd = mysqli_connect("localhost", "root", "", "sepgenerik");
    if (!$Bd) {
        die("Conexión fallida: " . mysqli_connect_error());
    } else {
        return $Bd;
    }
}
