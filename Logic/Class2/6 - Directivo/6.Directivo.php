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
    $query = "INSERT INTO directivos (usuario_Usu_Id, personas_Pers_id, EliminacionLogDir) VALUES ($idUsuario, $idPersona, 'A')";

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

// BUSCAR DIRECTOR EXISTE
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
