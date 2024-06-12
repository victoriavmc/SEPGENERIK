<?php
include './pagInicialArriba.php';

$usuario = $_GET['usuario'];
$idPlaAsis = $_GET['idPlanilla'];
$iddocente = $_GET['idDocente'];
$idGrado = $_GET['idGrados'];
$idEstudiante = $_GET['idEstudiante'];

$Bd = conexionBaseDatos();

// Obtener los valores actuales de la asistencia
$queryAsistencia = "SELECT * FROM asistencia WHERE idPlanAsi = $idPlaAsis";
$resultadoAsistencia = mysqli_query($Bd, $queryAsistencia);

if ($resultadoAsistencia) {
    $asistencia = mysqli_fetch_assoc($resultadoAsistencia);
} else {
    die("Error al obtener los datos de la asistencia: " . mysqli_error($Bd));
}

// COMBOBOX DOCENTE
$selectDocente = "SELECT docentes.id, CONCAT(pd.nombrePers, ' ', pd.apellidoPers) AS Docente
FROM docentes
JOIN personas AS pd ON docentes.personas_Pers_id = pd.idPers
WHERE docentes.EliminacionLogDoc = 'A'
ORDER BY docentes.id ASC";
$resultadoDOCENTE = mysqli_query($Bd, $selectDocente);
if (!$resultadoDOCENTE) {
    die("Error al obtener los docentes: " . mysqli_error($Bd));
}

// COMBOBOX ESTUDIANTE
$selectEstudiante = "SELECT estudiantes.idEst, CONCAT(pe.nombrePers, ' ', pe.apellidoPers) AS Estudiante
FROM estudiantes
JOIN personas AS pe ON estudiantes.personas_Pers_id = pe.idPers
WHERE estudiantes.EliminacionLogEst = 'A'
ORDER BY estudiantes.idEst ASC";
$resultadoESTUDIANTE = mysqli_query($Bd, $selectEstudiante);
if (!$resultadoESTUDIANTE) {
    die("Error al obtener los estudiantes: " . mysqli_error($Bd));
}

// COMBOBOX GRADOS
$selectGrados = "SELECT 
    gradosprog.idGrad, 
    CONCAT(gradosprog.numerogradoGrad, ' - ', d.nombreDivisionDivi, ' - ', t.horaTurno) AS Grado
FROM 
    gradosprog
JOIN 
    resgistroturnodivision AS rTD ON rTD.idRegTurnoDivi = gradosprog.resgistroturnodivision_Reg_TurnoDivi_id
JOIN 
    division AS d ON rTD.Division_Divi_id = d.idDivi
JOIN 
    turno AS t ON rTD.turno_Turno_id = t.idTurno
ORDER BY 
    gradosprog.idGrad ASC";
$resultadoGrado = mysqli_query($Bd, $selectGrados);
if (!$resultadoGrado) {
    die("Error al obtener los grados: " . mysqli_error($Bd));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tardanza = $_POST["Tardanza"] ?? '';
    $justificante = $_POST["Justificante"] ?? '';
    $inasistencia = $_POST["Inasistencia"] ?? '';
    $fecha = $_POST["Fecha"] ?? '';
    $docenteInput = $_POST["idDoc"] ?? '';
    $estudianteInput = $_POST["idEst"] ?? '';
    $gradoInput = $_POST["idGrad"] ?? '';

    $modificarAsistencia = "UPDATE asistencia 
    SET tardanzaPlanAsi = '$tardanza', 
        justificantePlanAsi = '$justificante', 
        inasistenciaPlanAsi = '$inasistencia', 
        fechaDiaPlanAsi = '$fecha', 
        grados_idGrad = '$gradoInput',
        docentes_id = '$docenteInput',
        estudiantes_idEst = '$estudianteInput'
    WHERE idPlanAsi = $idPlaAsis";

    if (mysqli_query($Bd, $modificarAsistencia)) {
        // Actualizar el historial
        $fecha = date('Y-m-d');
        $queryUltimoRegistro = "SELECT * FROM historial ORDER BY IDHistorial DESC LIMIT 1";
        $resultadoUltimoRegistro = mysqli_query($Bd, $queryUltimoRegistro);

        if ($resultadoUltimoRegistro && mysqli_num_rows($resultadoUltimoRegistro) > 0) {
            $ultimoRegistro = mysqli_fetch_assoc($resultadoUltimoRegistro);
            $ultimoIdModificado = $ultimoRegistro['IDHistorial'];
            $ultimoCreado = $ultimoRegistro['Hist_CampoModificado'];

            // Actualizar el registro anterior en Historial con el nuevo usuario
            $queryActualizar = "UPDATE historial SET Hist_Quien_Realizo_Cambio = '$usuario' WHERE IDHistorial = $ultimoIdModificado";
            mysqli_query($Bd, $queryActualizar);

            $queryInsertar = "INSERT INTO Historial (Hist_Accion, Hist_De_los_Modificados, Hist_CampoModificado, Hist_Quien_Realizo_Cambio, Hist_Fecha) VALUES ('Modificar', 'Planilla Asistencia', '$ultimoCreado', '$usuario', '$fecha')";
            mysqli_query($Bd, $queryInsertar);

            // Check if insertion was successful
            if (mysqli_affected_rows($Bd) > 0) {
                echo "<script>
                        alert('Éxito al modificar el usuario.');
                        window.location.href = './planillaAsistencia.php';
                      </script>";
            } else {
                echo "<script>alert('Error al crear el usuario en el historial.');</script>";
            }
        }
    } else {
        die("Error al modificar la asistencia: " . mysqli_error($Bd));
    }
}
?>

<div class='ladoDere70'>
    <div class='usarDisenio'>
        <div class="fondoDerechoCrud">
            <div class="crudDerecho">
                <div class='TituloCrud'>
                    <h1>Modificar Planilla de Asistencias</h1>
                </div>
                <form class="formulario-modificarAsistencia" method="POST">
                    <div class="campos">
                        <label for="Tardanza">Tardanza:</label>
                        <label>
                            <input type="radio" name="Tardanza" value="0" <?php echo $asistencia['tardanzaPlanAsi'] == '0' ? 'checked' : ''; ?>> No
                            <input type="radio" name="Tardanza" value="1" <?php echo $asistencia['tardanzaPlanAsi'] == '1' ? 'checked' : ''; ?>> Sí
                        </label>

                        <label for="Justificante">Justificante:</label>
                        <label>
                            <input type="radio" name="Justificante" value="0" <?php echo $asistencia['justificantePlanAsi'] == '0' ? 'checked' : ''; ?>> No
                            <input type="radio" name="Justificante" value="1" <?php echo $asistencia['justificantePlanAsi'] == '1' ? 'checked' : ''; ?>> Sí
                        </label>

                        <label for="Inasistencia">Inasistencia:</label>
                        <label>
                            <input type="radio" name="Inasistencia" value="0" <?php echo $asistencia['inasistenciaPlanAsi'] == '0' ? 'checked' : ''; ?>> No
                            <input type="radio" name="Inasistencia" value="1" <?php echo $asistencia['inasistenciaPlanAsi'] == '1' ? 'checked' : ''; ?>> Sí
                        </label>

                        <label for="Fecha">Fecha:</label>
                        <input type="date" name="Fecha" value="<?php echo $asistencia['fechaDiaPlanAsi']; ?>">
                    </div>

                    <label for="docente">Seleccione un Docente:</label>
                    <select name="idDoc" id="docente">
                        <?php
                        mysqli_data_seek($resultadoDOCENTE, 0);
                        while ($row = mysqli_fetch_assoc($resultadoDOCENTE)) : ?>
                            <option value="<?php echo $row['id']; ?>" <?php echo $row['id'] == $asistencia['docentes_id'] ? 'selected' : ''; ?>><?php echo $row['Docente']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <br>

                    <label for="estudiante">Seleccione un Estudiante:</label>
                    <select name="idEst" id="estudiante">
                        <?php
                        mysqli_data_seek($resultadoESTUDIANTE, 0);
                        while ($row = mysqli_fetch_assoc($resultadoESTUDIANTE)) : ?>
                            <option value="<?php echo $row['idEst']; ?>" <?php echo $row['idEst'] == $asistencia['estudiantes_idEst'] ? 'selected' : ''; ?>><?php echo $row['Estudiante']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <br>

                    <label for="grado">Seleccione un Grado:</label>
                    <select name="idGrad" id="grado">
                        <?php
                        mysqli_data_seek($resultadoGrado, 0);
                        while ($row = mysqli_fetch_assoc($resultadoGrado)) : ?>
                            <option value="<?php echo $row['idGrad']; ?>" <?php echo $row['idGrad'] == $asistencia['grados_idGrad'] ? 'selected' : ''; ?>><?php echo $row['Grado']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <br>

                    <button type="submit">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class='footer'>
    <?php $template_path = './footer.php';
    include $template_path; ?>
</div>
</body>

</html>