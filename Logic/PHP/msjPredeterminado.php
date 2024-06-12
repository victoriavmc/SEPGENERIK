<?php

function mensajePredeterminado($define, $pTextual, $pTabla)
{
    if ($define == 1) {
        $mensaje = "<script>alert('Error al " . $pTextual . " " . $pTabla . ".');</script>";
    } else {
        $mensaje = "<script>alert('Éxito al " . $pTextual . " " . $pTabla . ".');</script>";
    }
    return $mensaje;
}

function mensajeBusqueda($pTexto)
{
    $mensaje = "<script>alert('No se encontraron resultados para \"" . $pTexto . "\".');</script>";
    return $mensaje;
}
