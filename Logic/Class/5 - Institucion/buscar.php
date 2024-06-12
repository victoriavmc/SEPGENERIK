<?php
// Mensaje Predeterminado
include '../../PHP/msjPredeterminado.php';

// BUSCAR INSTITUCIÓN
function buscarInstitucion($Bd, $tipoBusqueda, $identInst)
{
    $accion = 'buscar';
    $tabla = 'institucion';
    $query = "";

    switch ($tipoBusqueda) {
        case '1':
            $query = "SELECT * FROM instituciones WHERE idInst = '$identInst'";
            break;
        case '2':
            $query = "SELECT * FROM instituciones WHERE domicilio_Doc_id = '$identInst'";
            break;
        default:
            echo mensajePredeterminado(2, $accion, $tabla);
            return array(null, false);
    }

    $resultado = mysqli_query($Bd, $query);
    if (mysqli_num_rows($resultado) > 0) {
        echo mensajePredeterminado(2, $accion, $tabla);
        return array($resultado, true);
    } else {
        echo mensajeBusqueda($tabla);
        return array(null, false);
    }
}

function mostrarInstitucionEspecifica($Bd, $tipoBusqueda, $identInst)
{
    // Llamamos a la función buscarInstitucion y obtenemos el resultado en un arreglo
    $resultado = buscarInstitucion($Bd, $tipoBusqueda, $identInst);

    if ($resultado[1]) {
        $institucion = mysqli_fetch_assoc($resultado[0]);
        $idInst = $institucion['idInst'];
        $nombrecolegioInst = $institucion['nombrecolegioInst'];
        $numerocolegioInst = $institucion['numerocolegioInst'];
        $linkInst = $institucion['linkInst'];
        $correoInst = $institucion['correoInst'];
        $telefonoInst = $institucion['telefonoInst'];
        $admin_Adm_id = $institucion['admin_Adm_id'];
        $domicilio_Doc_id = $institucion['domicilio_Doc_id'];

        // Mostrar los resultados
        echo "ID: " . $idInst . "\n";
        echo "Nombre del Colegio: " . $nombrecolegioInst . "\n";
        echo "Número del Colegio: " . $numerocolegioInst . "\n";
        echo "Link: " . $linkInst . "\n";
        echo "Correo: " . $correoInst . "\n";
        echo "Teléfono: " . $telefonoInst . "\n";
        echo "ID del Administrador: " . $admin_Adm_id . "\n";
        echo "ID del Domicilio: " . $domicilio_Doc_id . "\n";
    } else {
        echo "No se encontró ninguna institución con los criterios proporcionados.";
    }
}
?>