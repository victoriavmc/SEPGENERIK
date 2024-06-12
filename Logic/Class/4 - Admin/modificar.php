<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// ACTUALIZAR ADMIN
function actualizarAdmin($idAdmin, $correo, $idUsuario)
{
    $accion = 'actualizar';

    $Bd = conexionBaseDatos();
    $query = "UPDATE Admin SET correoAdm = '$correo', usuario_Usu_Id = $idUsuario WHERE idAdm = $idAdmin";

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
