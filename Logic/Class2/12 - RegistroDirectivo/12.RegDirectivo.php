<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// CREAR REGISTRO DE DIRECTOR
function crearRegistroDirector($fechaIngreso, $motivoBaja, $adminId, $directorId) {
    $accion = 'crear';
    
    $Bd = conexionBaseDatos();
    $query = "INSERT INTO registrodirectores (fechaIngresaRegDirecc, motivobajaRegDirecc, admin_Adm_id, directivos_Dir_id, EliminacionLogicaRegDirecc) 
              VALUES ('$fechaIngreso', '$motivoBaja', $adminId, $directorId, 'A')";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Registro de Director');
    echo $mensaje;

    mysqli_close($Bd);
}

// BUSCAR REGISTRO DE DIRECTOR
function buscarRegistroDirector($idRegistroDirector) {
    $accion = 'buscar';
    
    $Bd = conexionBaseDatos();
    
    $query = "SELECT * FROM registrodirectores WHERE idRegDirecc = $idRegistroDirector AND EliminacionLogicaRegDirecc = 'A'";
    $resultado = mysqli_query($Bd, $query);
    if (mysqli_num_rows($resultado) > 0){
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Registro de Director');
    echo $mensaje;

    mysqli_close($Bd);
}

// ACTUALIZAR REGISTRO DE DIRECTOR
function actualizarRegistroDirector($idRegistroDirector, $fechaIngreso, $motivoBaja, $adminId, $directorId) {
    $accion = 'actualizar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE registrodirectores 
              SET fechaIngresaRegDirecc = '$fechaIngreso', motivobajaRegDirecc = '$motivoBaja', 
              admin_Adm_id = $adminId, directivos_Dir_id = $directorId 
              WHERE idRegDirecc = $idRegistroDirector";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Registro de Director');
    echo $mensaje;

    mysqli_close($Bd);
}

// ELIMINAR REGISTRO DE DIRECTOR
function eliminarRegistroDirector($idRegistroDirector) {
    $accion = 'eliminar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE registrodirectores SET EliminacionLogicaRegDirecc = 'E' WHERE idRegDirecc = $idRegistroDirector";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Registro de Director');
    echo $mensaje;

    mysqli_close($Bd);
}
?>
