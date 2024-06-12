<?php
include '../../Connection/conexion.php';

function modificarUsuario($Bd, $userUsu, $estadorolUsu, $nombreRol, $IdUsu)
{
    $query = "UPDATE usuario SET userUsu = '$userUsu', estadorolUsu = '$estadorolUsu', nombreRol = $nombreRol WHERE IdUsu = $IdUsu";
    var_dump($query);
    mysqli_query($Bd, $query);
}
