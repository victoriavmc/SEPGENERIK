<?php
include './pagInicialArriba.php';

$usuario = $_GET['usuario'] ?? '';

$Bd = conexionBaseDatos();

// COMBOBOX DOCENTE
$selectDocente = "SELECT docentes.id , CONCAT(pd.nombrePers, ' ', pd.apellidoPers) AS Docente
FROM docentes
JOIN personas AS pd ON docentes.personas_Pers_id = pd.idPers
WHERE
    docentes.EliminacionLogDoc = 'A' 
ORDER BY docentes.id ASC";
$resultadoDOCENTE = mysqli_query($Bd, $selectDocente);
$docente = mysqli_fetch_assoc($resultadoDOCENTE);

$IDDocente = $docente["id"];
$DatoDocente = $docente["Docente"];

// COMBOBOX ESTUDIANTE
$selectEstudiante = "SELECT estudiantes.idEst , CONCAT(pe.nombrePers, ' ', pe.apellidoPers) AS Estudiante
FROM estudiantes
JOIN personas AS pe ON estudiantes.personas_Pers_id = pe.idPers
WHERE
    estudiantes.EliminacionLogEst = 'A' 
ORDER BY estudiantes.idEst ASC";
$resultadoESTUDIANTE = mysqli_query($Bd, $selectEstudiante);
$estudiante = mysqli_fetch_assoc($resultadoESTUDIANTE);

$IDEstudiante = $estudiante["idEst"];
$DatoEstudiante = $estudiante["Estudiante"];

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
$grado = mysqli_fetch_assoc($resultadoGrado);

$IDGrado = $grado["idGrad"];
$numeroGrado = $grado["Grado"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tardanza = $_POST["Tardanza"] ?? '';
    $justificante = $_POST["Justificante"] ?? '';
    $inasistencia = $_POST["Inasistencia"] ?? '';
    $fecha = $_POST["Fecha"] ?? '';
    $docenteInput = $_POST["idDoc"] ?? '';
    $estudianteInput = $_POST["idEst"] ?? '';
    $gradoInput = $_POST["idGrad"] ?? '';

    $insertarAsistencia = "INSERT INTO asistencia (tardanzaPlanAsi, justificantePlanAsi, inasistenciaPlanAsi, fechaDiaPlanAsi,EliminacionLogPlanAsi, docentes_id, grados_idGrad, estudiantes_idEst) VALUES ('$tardanza', '$justificante', '$inasistencia', '$fecha','A', '$docenteInput', '$gradoInput', '$estudianteInput')";
    mysqli_query($Bd, $insertarAsistencia);

    $fecha = date('y-m-d');
    $queryUltimoRegistro = "SELECT * FROM historial ORDER BY IDHistorial DESC LIMIT 1";
    $resultadoUltimoRegistro = mysqli_query($Bd, $queryUltimoRegistro);

    if ($resultadoUltimoRegistro && mysqli_num_rows($resultadoUltimoRegistro) > 0) {
        $ultimoRegistro = mysqli_fetch_assoc($resultadoUltimoRegistro);
        $ultimoIdModificado = $ultimoRegistro['IDHistorial'];
        $ultimoCreado = $ultimoRegistro['Hist_CampoModificado'];

        // Actualizar el registro anterior en Historial con el nuevo usuario
        $queryActualizar = "UPDATE historial SET Hist_Quien_Realizo_Cambio = '$usuario' WHERE IDHistorial = $ultimoIdModificado";
        mysqli_query($Bd, $queryActualizar);

        $queryInsertar = "INSERT INTO Historial (Hist_Accion, Hist_De_los_Modificados, Hist_CampoModificado, Hist_Quien_Realizo_Cambio, Hist_Fecha) VALUES ('Agrego', 'Planilla Asistencia', '$ultimoCreado', '$usuario', '$fecha')";
        mysqli_query($Bd, $queryInsertar);

        // Check if insertion was successful
        if (mysqli_affected_rows($Bd) > 0) {
            echo "<script>
        alert('Éxito al crear el usuario.');
        window.location.href = './planillaAsistencia.php';
      </script>";
        } else {
            echo "<script>alert('Error al crear el usuario.');</script>";
        }
    }
}
?>

<div class='ladoDere70'>
    <div class='usarDisenio'>
        <div class="fondoDerechoCrud">
            <div class="crudDerecho">
                <div class='TituloCrud'>
                    <h1>Agregar a la Planilla de Asistencias</h1>
                </div>
                <form class="formulario-crearAsistencia" method="POST">
                    <div class="campos">
                        <label for="Tardanza">Tardanza:</label>
                        <label>
                            <input type="radio" name="Tardanza" value="0"> No
                            <input type="radio" name="Tardanza" value="1"> Sí
                        </label>

                        <label for="Justificante">Justificante:</label>
                        <label>
                            <input type="radio" name="Justificante" value="0"> No
                            <input type="radio" name="Justificante" value="1"> Sí
                        </label>

                        <label for="Inasistencia">Inasistencia:</label>
                        <label>
                            <input type="radio" name="Inasistencia" value="0"> No
                            <input type="radio" name="Inasistencia" value="1"> Sí
                        </label>

                        <label for="Fecha">Fecha:</label>
                        <input type="date" name="Fecha" value="">

                    </div>

                    <label for="docente">Seleccione un Docente:</label>
                    <select name="idDoc" id="docente">
                        <?php
                        // Rewind the result set
                        mysqli_data_seek($resultadoDOCENTE, 0);
                        while ($row = mysqli_fetch_assoc($resultadoDOCENTE)) : ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['Docente']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <br>

                    <label for="estudiante">Seleccione un Estudiante:</label>
                    <select name="idEst" id="estudiante">
                        <?php
                        // Rewind the result set
                        mysqli_data_seek($resultadoESTUDIANTE, 0);
                        while ($row = mysqli_fetch_assoc($resultadoESTUDIANTE)) : ?>
                            <option value="<?php echo $row['idEst']; ?>"><?php echo $row['Estudiante']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <br>

                    <label for="grado">Seleccione un Grado:</label>
                    <select name="idGrad" id="grado">
                        <?php
                        // Rewind the result set
                        mysqli_data_seek($resultadoGrado, 0);
                        while ($row = mysqli_fetch_assoc($resultadoGrado)) : ?>
                            <option value="<?php echo $row['idGrad']; ?>"><?php echo $row['Grado']; ?></option>
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