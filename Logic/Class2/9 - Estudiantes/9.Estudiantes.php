<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// CREAR ESTUDIANTE
function crearEstudiante($fotocopiaDni, $estado, $idPersona) {
    $accion = 'crear';
    
    $Bd = conexionBaseDatos();
    $query = "INSERT INTO estudiantes (fotocopiadniEst, estadoEst, EliminacionLogEst, personas_Pers_id) VALUES ('$fotocopiaDni', '$estado', 'A', $idPersona)";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Estudiante');
    echo $mensaje;

    mysqli_close($Bd);
}

// BUSCAR ESTUDIANTE EXISTE
function buscarEstudiante($idEstudiante) {
    $accion = 'buscar';
    
    $Bd = conexionBaseDatos();
    
    $query = "SELECT * FROM estudiantes WHERE idEst = $idEstudiante AND EliminacionLogEst = 'A'";
    $resultado = mysqli_query($Bd, $query);
    if (mysqli_num_rows($resultado) > 0){
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Estudiante');
    echo $mensaje;

    mysqli_close($Bd);
}

// ACTUALIZAR ESTUDIANTE
function actualizarEstudiante($idEstudiante, $fotocopiaDni, $estado, $idPersona) {
    $accion = 'actualizar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE estudiantes SET fotocopiadniEst = '$fotocopiaDni', estadoEst = '$estado', personas_Pers_id = $idPersona WHERE idEst = $idEstudiante";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Estudiante');
    echo $mensaje;

    mysqli_close($Bd);
}

// ELIMINAR ESTUDIANTE
function eliminarEstudiante($idEstudiante) {
    $accion = 'eliminar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE estudiantes SET EliminacionLogEst = 'E' WHERE idEst = $idEstudiante";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Estudiante');
    echo $mensaje;

    mysqli_close($Bd);
}
