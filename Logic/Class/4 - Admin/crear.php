<?php
// Conexion
include '../../Connection/conexion.php';

// CREAR ADMIN
function crearAdmin($correo, $idUsuario)
{
    $accion = 'crear';

    $Bd = conexionBaseDatos();
    $query = "INSERT INTO Admin (correoAdm, usuario_Usu_Id) VALUES ('$correo', $idUsuario)";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Admin');
    echo $mensaje;

    mysqli_close($Bd);
}
