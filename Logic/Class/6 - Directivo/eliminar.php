<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// ELIMINAR DIRECTOR
function eliminarDirectivos($idDir)
{
    $accion = 'eliminar';

    $Bd = conexionBaseDatos();
    $query = "UPDATE directivos SET EliminacionLogDir = 'E' WHERE idDir = $idDir";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'directivos');
    echo $mensaje;

    mysqli_close($Bd);
}
