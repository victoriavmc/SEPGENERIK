<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// CREAR REGISTRO DE PLANILLAS DE DOCENTE
function crearRegistroPlanillasDocente($fechaInicio, $estado, $fechaAlta, $gradoId, $docenteId) {
    $accion = 'crear';
    
    $Bd = conexionBaseDatos();
    $query = "INSERT INTO registrodeplanillasdocente (fechaInicioRegPlaDoc, estadoRegPlaDoc, fechaAltaRegPlaDoc, grados_Grad_id, docentes_Doc_id, EliminacionLogiRegPlaDoc) 
              VALUES ('$fechaInicio', '$estado', '$fechaAlta', $gradoId, $docenteId, 'A')";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Registro de Planillas de Docente');
    echo $mensaje;

    mysqli_close($Bd);
}

// BUSCAR REGISTRO DE PLANILLAS DE DOCENTE
function buscarRegistroPlanillasDocente($idRegistroPlanillasDocente) {
    $accion = 'buscar';
    
    $Bd = conexionBaseDatos();
    
    $query = "SELECT * FROM registrodeplanillasdocente WHERE IdRegPlaDoc = $idRegistroPlanillasDocente AND EliminacionLogiRegPlaDoc = 'A'";
    $resultado = mysqli_query($Bd, $query);
    if (mysqli_num_rows($resultado) > 0){
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Registro de Planillas de Docente');
    echo $mensaje;

    mysqli_close($Bd);
}

// ACTUALIZAR REGISTRO DE PLANILLAS DE DOCENTE
function actualizarRegistroPlanillasDocente($idRegistroPlanillasDocente, $fechaInicio, $estado, $fechaAlta, $gradoId, $docenteId) {
    $accion = 'actualizar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE registrodeplanillasdocente 
              SET fechaInicioRegPlaDoc = '$fechaInicio', estadoRegPlaDoc = '$estado', fechaAltaRegPlaDoc = '$fechaAlta', 
              grados_Grad_id = $gradoId, docentes_Doc_id = $docenteId 
              WHERE IdRegPlaDoc = $idRegistroPlanillasDocente";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Registro de Planillas de Docente');
    echo $mensaje;

    mysqli_close($Bd);
}

// ELIMINAR REGISTRO DE PLANILLAS DE DOCENTE
function eliminarRegistroPlanillasDocente($idRegistroPlanillasDocente) {
    $accion = 'eliminar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE registrodeplanillasdocente SET EliminacionLogiRegPlaDoc = 'B' WHERE IdRegPlaDoc = $idRegistroPlanillasDocente";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Registro de Planillas de Docente');
    echo $mensaje;

    mysqli_close($Bd);
}
?>
