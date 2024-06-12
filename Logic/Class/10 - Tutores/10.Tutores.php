<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// CREAR TUTOR
function crearTutor($idEstudiante, $idTutor) {
    $accion = 'crear';
    
    $Bd = conexionBaseDatos();
    $query = "INSERT INTO tutores (estudiantes_Est_id, tutor_Tutor_id, EliminacionLogTutores) VALUES ($idEstudiante, $idTutor, 'A')";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Tutores');
    echo $mensaje;

    mysqli_close($Bd);
}

// BUSCAR TUTOR EXISTE
function buscarTutor($idTutor) {
    $accion = 'buscar';
    
    $Bd = conexionBaseDatos();
    
    $query = "SELECT * FROM tutores WHERE IDTutores = $idTutor AND EliminacionLogTutores = 'A'";
    $resultado = mysqli_query($Bd, $query);
    if (mysqli_num_rows($resultado) > 0){
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Tutores');
    echo $mensaje;

    mysqli_close($Bd);
}

// ACTUALIZAR TUTOR
function actualizarTutor($idTutor, $idEstudiante, $idTutorNuevo) {
    $accion = 'actualizar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE tutores SET estudiantes_Est_id = $idEstudiante, tutor_Tutor_id = $idTutorNuevo WHERE IDTutores = $idTutor";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Tutores');
    echo $mensaje;

    mysqli_close($Bd);
}

// ELIMINAR TUTOR
function eliminarTutor($idTutor) {
    $accion = 'eliminar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE tutores SET EliminacionLogTutores = 'E' WHERE IDTutores = $idTutor";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Tutores');
    echo $mensaje;

    mysqli_close($Bd);
}
?>
