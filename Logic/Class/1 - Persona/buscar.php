<?php
include '../../PHP/msjPredeterminado.php';

function buscarPersona($Bd, $tipoBusqueda, $identPer)
{
    $accion = 'buscar';
    $tabla = 'persona';
    switch ($tipoBusqueda) {
        case '1':
            $query = "SELECT * FROM personas WHERE idPers = '$identPer' ";
            $resultado = mysqli_query($Bd, $query);
            if (mysqli_num_rows($resultado) > 0) {
                echo mensajePredeterminado(2, $accion, $tabla);
                return array($resultado, true);
                break;
            } else {
                echo mensajeBusqueda($tabla);
                return array(null, false);
                break;
            }
        case '2':
            $query = "SELECT * FROM personas WHERE cuilPers = '$identPer' ";
            $resultado = mysqli_query($Bd, $query);
            if (mysqli_num_rows($resultado) > 0) {
                echo mensajePredeterminado(2, $accion, $tabla);
                return array($resultado, true);
                break;
            } else {
                echo mensajeBusqueda($tabla);
                return array(null, false);
                break;
            }
        default:
            return mensajePredeterminado(2, $accion, $tabla);
            break;
    }
}

function mostrarPersonaEspecifica($Bd, $tipoBusqueda, $numPersona)
{
    $resultado = buscarPersona($Bd, $tipoBusqueda, $numPersona);
    if ($resultado[1]) {
        $persona = mysqli_fetch_assoc($resultado[0]);
        $id = $persona['idPers'];
        $nombre = $persona['nombrePers'];
        $apellido = $persona['apellidoPers'];
        $fechanacimiento = $persona['fechanacimientoPers'];
        $cuil = $persona['cuilPers'];
        $sexo = $persona['sexoPers'];
        $nacionalidad = $persona['nacionalidadPers'];
        $provincia = $persona['provinciaPers'];
        $dni = $persona['dniPers'];
        if ($resultado[1]) {
            echo "<table border='1'>";
            echo "<tr><th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Fecha de Nacimiento</th>
            <th>CUIL</th>
            <th>Sexo</th>
            <th>Nacionalidad</th>
            <th>Provincia</th>
            <th>DNI</th>";
            echo "<tr>";
            echo "<td>" . $id . "</td>";
            echo "<td>" . $nombre . "</td>";
            echo "<td>" . $apellido . "</td>";
            echo "<td>" . $fechanacimiento . "</td>";
            echo "<td>" . $cuil . "</td>";
            echo "<td>" . $sexo . "</td>";
            echo "<td>" . $nacionalidad . "</td>";
            echo "<td>" . $provincia . "</td>";
            echo "<td>" . $dni . "</td>";
            echo "</tr>";
            echo "</table>";
        }
    }
}
