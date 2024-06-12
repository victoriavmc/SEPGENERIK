<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// CREAR ADMIN
function crearAdmin($correo, $idUsuario) {
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

// BUSCAR ADMIN EXISTE
function buscarAdmin($idAdmin) {
    $accion = 'buscar';
    
    $Bd = conexionBaseDatos();
    
    $query = "SELECT * FROM Admin WHERE idAdm = $idAdmin";
    $resultado = mysqli_query($Bd, $query);
    if (mysqli_num_rows($resultado) > 0){
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Admin');
    echo $mensaje;

    mysqli_close($Bd);
}

// ACTUALIZAR ADMIN
function actualizarAdmin($idAdmin, $correo, $idUsuario) {
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

// ELIMINAR ADMIN
function eliminarAdmin($idAdmin) {
    $accion = 'eliminar';
    
    $Bd = conexionBaseDatos();
    $query = "DELETE FROM Admin WHERE idAdm = $idAdmin";

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
