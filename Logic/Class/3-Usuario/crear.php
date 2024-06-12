<?php
// Conexion
include '../../Connection/conexion.php';

// Mensaje Predeterminado
include '../../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'usuario');

// CREAR usuario
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Bd = conexionBaseDatos();
    $user = mysqli_real_escape_string($Bd, $_POST['user']);
    $contrasenia = mysqli_real_escape_string($Bd, $_POST['contrasenia']);
    $pinolvido = mysqli_real_escape_string($Bd, $_POST['pinolvido']);
    $estadoRol = mysqli_real_escape_string($Bd, $_POST['estadoRol']);
    $rol = mysqli_real_escape_string($Bd, $_POST['rol']);

    crearUsuario($Bd, $user, $contrasenia, $pinolvido, $estadoRol, $rol);
}
