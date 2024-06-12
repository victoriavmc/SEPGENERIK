<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// CREAR CONTACTO
function crearContacto($correo, $telefono, $idPersona) {
    $accion = 'crear';
    
    $Bd = conexionBaseDatos();
    $query = "INSERT INTO contacto (correoCont, telefonoCont, EliminacionLogCont, personas_Pers_id) VALUES ('$correo', '$telefono', 'A', $idPersona)";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Contacto');
    echo $mensaje;

    mysqli_close($Bd);
}

// BUSCAR CONTACTO EXISTE
function buscarContacto($idContacto) {
    $accion = 'buscar';
    
    $Bd = conexionBaseDatos();
    
    $query = "SELECT * FROM contacto WHERE idCont = $idContacto AND EliminacionLogCont = 'A'";
    $resultado = mysqli_query($Bd, $query);
    if (mysqli_num_rows($resultado) > 0){
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Contacto');
    echo $mensaje;

    mysqli_close($Bd);
}

// ACTUALIZAR CONTACTO
function actualizarContacto($idContacto, $correo, $telefono, $idPersona) {
    $accion = 'actualizar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE contacto SET correoCont = '$correo', telefonoCont = '$telefono', personas_Pers_id = $idPersona WHERE idCont = $idContacto";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Contacto');
    echo $mensaje;

    mysqli_close($Bd);
}

// ELIMINAR CONTACTO
function eliminarContacto($idContacto) {
    $accion = 'eliminar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE contacto SET EliminacionLogCont = 'E' WHERE idCont = $idContacto";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'Contacto');
    echo $mensaje;

    mysqli_close($Bd);
}
?>
