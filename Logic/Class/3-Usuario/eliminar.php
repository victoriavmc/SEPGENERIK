<?php
// Conexion
include '../../Connection/conexion.php';

function eliminarUsuarioLog($identUsu)
{
    $Bd = conexionBaseDatos();
    $query = "UPDATE usuario SET eliminacionLogUsu = 'E' WHERE idUsu = $identUsu";
    mysqli_query($Bd, $query);
}
