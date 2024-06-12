<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// CREAR docentes
function crearDocentes($idUsuario, $idPersona)
{
    $accion = 'crear';

    $Bd = conexionBaseDatos();
    $query = "INSERT INTO docentes (usuario_Usu_Id, personas_Pers_id, EliminacionLogDoc) VALUES ($idUsuario, $idPersona, 'A')";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'docentes');
    echo $mensaje;

    mysqli_close($Bd);
}

// BUSCAR Docentes EXISTE
function buscarDocentes($idDoc)
{
    $accion = 'buscar';

    $Bd = conexionBaseDatos();

    $query = "SELECT * FROM docentes WHERE idDoc = $idDoc AND EliminacionLogDoc = 'A'";
    $resultado = mysqli_query($Bd, $query);
    if (mysqli_num_rows($resultado) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'docentes');
    echo $mensaje;

    mysqli_close($Bd);
}

// ACTUALIZAR Docentes
function actualizarDocentes($idDoc, $idUsuario, $idPersona)
{
    $accion = 'actualizar';

    $Bd = conexionBaseDatos();
    $query = "UPDATE docentes SET usuario_Usu_Id = $idUsuario, personas_Pers_id = $idPersona WHERE idDoc = $idDoc";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'docentes');
    echo $mensaje;

    mysqli_close($Bd);
}

// ELIMINAR Docentes
function eliminarDocentes($idDoc)
{
    $accion = 'eliminar';

    $Bd = conexionBaseDatos();
    $query = "UPDATE docentes SET EliminacionLogDoc = 'E' WHERE idDoc = $idDoc";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'docentes');
    echo $mensaje;

    mysqli_close($Bd);
}
