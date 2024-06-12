<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// ACTUALIZAR DIRECTOR
function actualizarDirectivos($idDir, $idUsuario, $idPersona)
{
    $accion = 'actualizar';

    $Bd = conexionBaseDatos();
    $query = "UPDATE directivos SET usuario_Usu_Id = $idUsuario, personas_Pers_id = $idPersona WHERE idDir = $idDir";

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
