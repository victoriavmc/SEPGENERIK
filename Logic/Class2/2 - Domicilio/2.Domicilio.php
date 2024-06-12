<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// CREAR DOMICILIO
function crearDomicilio($barrio, $calle, $altura, $persID) {
    $accion = 'crear';
    
    $Bd = conexionBaseDatos();
    $query = "INSERT INTO domicilio (BarrioDom, CalleDom, AlturaDom, EliminacionLogDom, personas_Pers_id) VALUES ('$barrio', '$calle', '$altura', 'A', '$persID')";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'domicilio');
    echo $mensaje;

    mysqli_close($Bd);
}

// BUSCAR DOMICILIO EXISTE
function buscarDomicilio($idDomicilio) {
    $accion = 'buscar';
    
    $Bd = conexionBaseDatos();
    
    $query = "SELECT * FROM domicilio WHERE idDomicilio = $idDomicilio AND EliminacionLogDom = 'A'";
    $resultado = mysqli_query($Bd, $query);
    if (mysqli_num_rows($resultado) > 0){
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'domicilio');
    echo $mensaje;

    mysqli_close($Bd);
}

// ACTUALIZAR DOMICILIO
function actualizarDomicilio($idDomicilio, $barrio, $calle, $altura) {
    $accion = 'actualizar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE domicilio SET BarrioDom = '$barrio', CalleDom = '$calle', AlturaDom = '$altura' WHERE idDomicilio = $idDomicilio";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'domicilio');
    echo $mensaje;

    mysqli_close($Bd);
}

// ELIMINAR DOMICILIO
function eliminarDomicilio($idDomicilio) {
    $accion = 'eliminar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE domicilio SET EliminacionLogDom = 'E' WHERE idDomicilio = $idDomicilio";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'domicilio');
    echo $mensaje;

    mysqli_close($Bd);
}
