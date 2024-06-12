<?php
include './pagInicialArriba.php';

$usuario = $_GET['usuario'];
$idPlaAsis = $_GET['idPlanilla'];
$iddocente = $_GET['idDocente'];
$idGrado = $_GET['idGrados'];
$idEstudiante = $_GET['idEstudiante'];

eliminarUsuario($usuario, $idPlaAsis);

function eliminarUsuario($nombreUsuario, $idAsis)
{
    $fecha = date('y-m-d');
    $Bd = conexionBaseDatos();
    $query = "UPDATE asistencia SET EliminacionLogPlanAsi = 'E' WHERE idPlanAsi = $idAsis";
    $resultado = mysqli_query($Bd, $query);


    $queryUltimoRegistro = "SELECT * FROM Historial ORDER BY idHistorial DESC LIMIT 1";
    $resultadoUltimoRegistro = mysqli_query($Bd, $queryUltimoRegistro);

    if ($resultadoUltimoRegistro && mysqli_num_rows($resultadoUltimoRegistro) > 0) {
        $ultimoRegistro = mysqli_fetch_assoc($resultadoUltimoRegistro);
        $ultimoIdModificado = $ultimoRegistro['IDHistorial'];

        // Actualizar el registro anterior en Historial con el nuevo usuario
        $queryActualizar = "UPDATE Historial SET Hist_Quien_Realizo_Cambio = '$nombreUsuario' WHERE idHistorial = $ultimoIdModificado";
        mysqli_query($Bd, $queryActualizar);
    }
    $queryInsertar = "INSERT INTO Historial (Hist_Accion, Hist_De_los_Modificados, Hist_CampoModificado, Hist_Quien_Realizo_Cambio, Hist_Fecha) VALUES ('Eliminación de usuario', 'Planilla Asistencia', '$idAsis', '$nombreUsuario', '$fecha')";
    mysqli_query($Bd, $queryInsertar);

    if ($resultado === true) {
        echo "<script>
        alert('Éxito al eliminar el usuario.');
        window.location.href = './planillaAsistencia.php';
      </script>";
    } else {
        echo "<script>alert('Error al eliminar el usuario.');</script>";
    }
}
