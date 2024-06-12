<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

function buscarDirectivos($idDir)
{
    $accion = 'buscar';

    $Bd = conexionBaseDatos();

    $query = "SELECT * FROM directivos WHERE idDir = $idDir AND EliminacionLogDir = 'A'";
    $resultado = mysqli_query($Bd, $query);
    if (mysqli_num_rows($resultado) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'directivos');
    echo $mensaje;

    mysqli_close($Bd);
}
