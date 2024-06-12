<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// CREAR REGISTRO DE PLANILLA DE ESTUDIANTE
function crearRegistroPlanillaEstudiante($fechaInicio, $estado, $fechaBaja, $gradoId, $matriculaEstudianteId) {
    $accion = 'crear';
    
    $Bd = conexionBaseDatos();
    $query = "INSERT INTO registrodeplanillaestudiante (fechaInicioRegPlaEst, estadoRegPlaEst, fechaBajaRegPlaEst, grados_Grad_id, matricularestudiante_Matric_Est_id, EliminacionLogiRegPlaEst) 
              VALUES ('$fechaInicio', '$estado', '$fechaBaja', $gradoId, $matriculaEstudianteId, 'A')";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Registro de Planilla de Estudiante');
    echo $mensaje;

    mysqli_close($Bd);
}

// BUSCAR REGISTRO DE PLANILLA DE ESTUDIANTE
function buscarRegistroPlanillaEstudiante($idRegistroPlanillaEstudiante) {
    $accion = 'buscar';
    
    $Bd = conexionBaseDatos();
    
    $query = "SELECT * FROM registrodeplanillaestudiante WHERE idRegPlaEst = $idRegistroPlanillaEstudiante AND EliminacionLogiRegPlaEst = 'A'";
    $resultado = mysqli_query($Bd, $query);
    if (mysqli_num_rows($resultado) > 0){
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Registro de Planilla de Estudiante');
    echo $mensaje;

    mysqli_close($Bd);
}

// ACTUALIZAR REGISTRO DE PLANILLA DE ESTUDIANTE
function actualizarRegistroPlanillaEstudiante($idRegistroPlanillaEstudiante, $fechaInicio, $estado, $fechaBaja, $gradoId, $matriculaEstudianteId) {
    $accion = 'actualizar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE registrodeplanillaestudiante 
              SET fechaInicioRegPlaEst = '$fechaInicio', estadoRegPlaEst = '$estado', fechaBajaRegPlaEst = '$fechaBaja', 
              grados_Grad_id = $gradoId, matricularestudiante_Matric_Est_id = $matriculaEstudianteId 
              WHERE idRegPlaEst = $idRegistroPlanillaEstudiante";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Registro de Planilla de Estudiante');
    echo $mensaje;

    mysqli_close($Bd);
}

// ELIMINAR REGISTRO DE PLANILLA DE ESTUDIANTE
function eliminarRegistroPlanillaEstudiante($idRegistroPlanillaEstudiante) {
    $accion = 'eliminar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE registrodeplanillaestudiante SET EliminacionLogiRegPlaEst = 'E' WHERE idRegPlaEst = $idRegistroPlanillaEstudiante";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Registro de Planilla de Estudiante');
    echo $mensaje;

    mysqli_close($Bd);
}
?>
