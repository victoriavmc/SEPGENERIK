<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// CREAR REGISTRO DE DOCENTE
function crearRegistroDocente($fechaIngreso, $motivoBaja, $directorId, $docenteId) {
    $accion = 'crear';
    
    $Bd = conexionBaseDatos();
    $query = "INSERT INTO registrodocente (fechaIngresaRegDoc, motivobajaRegDoc, directivos_Dir_id, docentes_Doc_id, EliminacionLogRegDoc) 
              VALUES ('$fechaIngreso', '$motivoBaja', $directorId, $docenteId, 'A')";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Registro de Docente');
    echo $mensaje;

    mysqli_close($Bd);
}

// BUSCAR REGISTRO DE DOCENTE
function buscarRegistroDocente($idRegistroDocente) {
    $accion = 'buscar';
    
    $Bd = conexionBaseDatos();
    
    $query = "SELECT * FROM registrodocente WHERE idRegDoc = $idRegistroDocente AND EliminacionLogRegDoc = 'A'";
    $resultado = mysqli_query($Bd, $query);
    if (mysqli_num_rows($resultado) > 0){
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Registro de Docente');
    echo $mensaje;

    mysqli_close($Bd);
}

// ACTUALIZAR REGISTRO DE DOCENTE
function actualizarRegistroDocente($idRegistroDocente, $fechaIngreso, $motivoBaja, $directorId, $docenteId) {
    $accion = 'actualizar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE registrodocente 
              SET fechaIngresaRegDoc = '$fechaIngreso', motivobajaRegDoc = '$motivoBaja', 
              directivos_Dir_id = $directorId, docentes_Doc_id = $docenteId 
              WHERE idRegDoc = $idRegistroDocente";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Registro de Docente');
    echo $mensaje;

    mysqli_close($Bd);
}

// ELIMINAR REGISTRO DE DOCENTE
function eliminarRegistroDocente($idRegistroDocente) {
    $accion = 'eliminar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE registrodocente SET EliminacionLogRegDoc = 'E' WHERE idRegDoc = $idRegistroDocente";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Registro de Docente');
    echo $mensaje;

    mysqli_close($Bd);
}
?>
