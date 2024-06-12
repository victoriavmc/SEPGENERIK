<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// CREAR INSTITUCIÓN
function crearInstitucion($nombre, $numeroColegio, $link, $correo, $telefono, $idDomicilio, $idAdmin) {
    $accion = 'crear';
    
    $Bd = conexionBaseDatos();
    $query = "INSERT INTO institucion (nombrecolegioInst, numerocolegioInst, linkInst, CorreoInst, telefonoInst, EliminacionLogInst, domicilio_Doc_id, admin_Adm_id) VALUES ('$nombre', '$numeroColegio', '$link', '$correo', '$telefono', 'A', $idDomicilio, $idAdmin)";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'institución');
    echo $mensaje;

    mysqli_close($Bd);
}

// BUSCAR INSTITUCIÓN EXISTE
function buscarInstitucion($idInstitucion) {
    $accion = 'buscar';
    
    $Bd = conexionBaseDatos();
    
    $query = "SELECT * FROM institucion WHERE idInst = $idInstitucion AND EliminacionLogInst = 'A'";
    $resultado = mysqli_query($Bd, $query);
    if (mysqli_num_rows($resultado) > 0){
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'institución');
    echo $mensaje;

    mysqli_close($Bd);
}

// ACTUALIZAR INSTITUCIÓN
function actualizarInstitucion($idInstitucion, $nombre, $numeroColegio, $link, $correo, $telefono, $idDomicilio, $idAdmin) {
    $accion = 'actualizar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE institucion SET nombrecolegioInst = '$nombre', numerocolegioInst = '$numeroColegio', linkInst = '$link', CorreoInst = '$correo', telefonoInst = '$telefono', domicilio_Doc_id = $idDomicilio, admin_Adm_id = $idAdmin WHERE idInst = $idInstitucion";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'institución');
    echo $mensaje;

    mysqli_close($Bd);
}

// ELIMINAR INSTITUCIÓN
function eliminarInstitucion($idInstitucion) {
    $accion = 'eliminar';
    
    $Bd = conexionBaseDatos();
    $query = "UPDATE institucion SET EliminacionLogInst = 'E' WHERE idInst = $idInstitucion";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'institución');
    echo $mensaje;

    mysqli_close($Bd);
}
