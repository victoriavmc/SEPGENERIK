<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// CREAR PLANILLA DE ASISTENCIA
function crearPlanillaAsistencia($tardanza, $justificante, $inasistencia, $fechaDia, $registroDocenteId, $registroEstudianteId) {
    $accion = 'crear';
    
    $Bd = conexionBaseDatos();
    $query = "INSERT INTO planillaasistencia (tardanzaPlanAsi, justificantePlanAsi, inasistenciaPlanAsi, fechaDiaPlanAsi, registrodeplanillasdocente_Reg_Pla_Doc_Id, registrodeplanillaestudiante_Reg_Pla_Est_id, EliminacionLogPlanAsi) 
              VALUES ('$tardanza', '$justificante', '$inasistencia', '$fechaDia', $registroDocenteId, $registroEstudianteId, 'A')";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Planilla de Asistencia');
    echo $mensaje;

    mysqli_close($Bd);
}

// BUSCAR PLANILLA DE ASISTENCIA
function buscarPlanillaAsistencia($idPlanillaAsistencia) {
    $accion = 'buscar';
    
    $Bd = conexionBaseDatos();
    
    $query = "SELECT * FROM planillaasistencia WHERE idPlanAsi = $idPlanillaAsistencia AND EliminacionLogPlanAsi = 'A'";
    $resultado = mysqli_query($Bd, $query);
    if (mysqli_num_rows($resultado) > 0){
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Planilla de Asistencia');
    echo $mensaje;

    mysqli_close($Bd);
}

// ACTUALIZAR PLANILLA DE ASISTENCIA
function actualizarPlanillaAsistencia($idPlanillaAsistencia, $tardanza, $justificante, $inasistencia, $fechaDia, $registroDocenteId, $registroEstudianteId) {
    $accion = 'actualizar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE planillaasistencia 
              SET tardanzaPlanAsi = '$tardanza', justificantePlanAsi = '$justificante', inasistenciaPlanAsi = '$inasistencia', 
              fechaDiaPlanAsi = '$fechaDia', registrodeplanillasdocente_Reg_Pla_Doc_Id = $registroDocenteId, 
              registrodeplanillaestudiante_Reg_Pla_Est_id = $registroEstudianteId 
              WHERE idPlanAsi = $idPlanillaAsistencia";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Planilla de Asistencia');
    echo $mensaje;

    mysqli_close($Bd);
}

// ELIMINAR PLANILLA DE ASISTENCIA
function eliminarPlanillaAsistencia($idPlanillaAsistencia) {
    $accion = 'eliminar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE planillaasistencia SET EliminacionLogPlanAsi = 'E' WHERE idPlanAsi = $idPlanillaAsistencia";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Planilla de Asistencia');
    echo $mensaje;

    mysqli_close($Bd);
}
?>
