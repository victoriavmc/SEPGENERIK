<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// CREAR DIRECTOR
function crearDirectivos($idUsuario, $idPersona)
{
    $accion = 'crear';
    $Bd = conexionBaseDatos();

    $queryInsert = "INSERT INTO directivos (usuario_Usu_Id, personas_Pers_id, EliminacionLogDir) VALUES ($idUsuario, $idPersona, 'A')";
    mysqli_query($Bd, $queryInsert);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'directivos');
    echo $mensaje;

    mysqli_close($Bd);
}
