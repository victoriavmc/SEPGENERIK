<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// CREAR USUARIO
function crearUsuario($usuario, $contrasenia, $pinOlvido, $estadoRol, $idPreRol)
{
    $accion = 'crear';

    $Bd = conexionBaseDatos();
    $query = "INSERT INTO usuario (userUsu, contraseniaUsu, pinolvidoUsu, estadorolUsu, eliminacionLogUsu, PreestablecerRol_PreestablecerRol_id) VALUES ('$usuario', '$contrasenia', '$pinOlvido', '$estadoRol', 'A', $idPreRol)";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'usuario');
    echo $mensaje;

    mysqli_close($Bd);
}

// BUSCAR USUARIO EXISTE
function buscarUsuario($idUsuario)
{
    $accion = 'buscar';

    $Bd = conexionBaseDatos();

    $query = "SELECT * FROM usuario WHERE IdUsu = $idUsuario AND eliminacionLogUsu = 'A'";
    $resultado = mysqli_query($Bd, $query);
    if (mysqli_num_rows($resultado) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'usuario');
    echo $mensaje;

    mysqli_close($Bd);
}

// ACTUALIZAR USUARIO
function actualizarUsuario($idUsuario, $usuario, $contrasenia, $pinOlvido, $estadoRol, $idPreRol)
{
    $accion = 'actualizar';

    $Bd = conexionBaseDatos();
    $query = "UPDATE usuario SET userUsu = '$usuario', contraseniaUsu = '$contrasenia', pinolvidoUsu = '$pinOlvido', estadorolUsu = '$estadoRol', PreestablecerRol_PreestablecerRol_id = $idPreRol WHERE IdUsu = $idUsuario";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'usuario');
    echo $mensaje;

    mysqli_close($Bd);
}

// ELIMINAR USUARIO
function eliminarUsuario($idUsuario)
{
    $accion = 'eliminar';

    $Bd = conexionBaseDatos();
    $query = "UPDATE usuario SET eliminacionLogUsu = 'E' WHERE IdUsu = $idUsuario";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'usuario');
    echo $mensaje;

    mysqli_close($Bd);
}
