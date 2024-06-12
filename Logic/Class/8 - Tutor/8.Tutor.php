<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// CREAR TUTOR
function crearTutor($idPersona) {
    $accion = 'crear';
    
    $Bd = conexionBaseDatos();
    $query = "INSERT INTO tutor (personas_Pers_id, EliminacionLogiTutor) VALUES ($idPersona, 'A')";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Tutor');
    echo $mensaje;

    mysqli_close($Bd);
}

// BUSCAR TUTOR EXISTE
function buscarTutor($idTutor) {
    $accion = 'buscar';
    
    $Bd = conexionBaseDatos();
    
    $query = "SELECT * FROM tutor WHERE idTutor = $idTutor AND EliminacionLogiTutor = 'A'";
    $resultado = mysqli_query($Bd, $query);
    if (mysqli_num_rows($resultado) > 0){
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Tutor');
    echo $mensaje;

    mysqli_close($Bd);
}

// ACTUALIZAR TUTOR
function actualizarTutor($idTutor, $idPersona) {
    $accion = 'actualizar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE tutor SET personas_Pers_id = $idPersona WHERE idTutor = $idTutor";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Tutor');
    echo $mensaje;

    mysqli_close($Bd);
}

// ELIMINAR TUTOR
function eliminarTutor($idTutor) {
    $accion = 'eliminar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE tutor SET EliminacionLogiTutor = 'E' WHERE idTutor = $idTutor";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Tutor');
    echo $mensaje;

    mysqli_close($Bd);
}
