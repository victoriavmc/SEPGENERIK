<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// CREAR MATRÍCULA DE ESTUDIANTE
function crearMatriculaEstudiante($fechaIngreso, $motivoBaja, $docenteId, $estudianteId) {
    $accion = 'crear';
    
    $Bd = conexionBaseDatos();
    $query = "INSERT INTO matricularestudiante (fechaIngresaMatricEst, motivobajaMatricEst, docentes_Doc_id, estudiantes_Est_id, EliminacionLogMatricEst) 
              VALUES ('$fechaIngreso', '$motivoBaja', $docenteId, $estudianteId, 'A')";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Matrícula de Estudiante');
    echo $mensaje;

    mysqli_close($Bd);
}

// BUSCAR MATRÍCULA DE ESTUDIANTE
function buscarMatriculaEstudiante($idMatriculaEstudiante) {
    $accion = 'buscar';
    
    $Bd = conexionBaseDatos();
    
    $query = "SELECT * FROM matricularestudiante WHERE idMatricEst = $idMatriculaEstudiante AND EliminacionLogMatricEst = 'A'";
    $resultado = mysqli_query($Bd, $query);
    if (mysqli_num_rows($resultado) > 0){
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Matrícula de Estudiante');
    echo $mensaje;

    mysqli_close($Bd);
}

// ACTUALIZAR MATRÍCULA DE ESTUDIANTE
function actualizarMatriculaEstudiante($idMatriculaEstudiante, $fechaIngreso, $motivoBaja, $docenteId, $estudianteId) {
    $accion = 'actualizar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE matricularestudiante 
              SET fechaIngresaMatricEst = '$fechaIngreso', motivobajaMatricEst = '$motivoBaja', 
              docentes_Doc_id = $docenteId, estudiantes_Est_id = $estudianteId 
              WHERE idMatricEst = $idMatriculaEstudiante";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Matrícula de Estudiante');
    echo $mensaje;

    mysqli_close($Bd);
}

// ELIMINAR MATRÍCULA DE ESTUDIANTE
function eliminarMatriculaEstudiante($idMatriculaEstudiante) {
    $accion = 'eliminar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE matricularestudiante SET EliminacionLogMatricEst = 'E' WHERE idMatricEst = $idMatriculaEstudiante";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Matrícula de Estudiante');
    echo $mensaje;

    mysqli_close($Bd);
}
?>
