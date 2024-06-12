<?php
include './pagInicialArriba.php';
$idUsuario =  $id;
$usuarioUser = $usuario;
?>

<div class='ladoDere70'>
    <div class='usarDisenio'>
        <div class="fondoDerechoCrud">
            <div class="crudDerecho">
                <div class='TituloCrud'>
                    <h1>Planilla de Asistencias</h1>
                </div>
                <?php
                $Bd = conexionBaseDatos();
                $query = "SELECT
                asistencia.idPlanAsi,
                asistencia.tardanzaPlanAsi,
                asistencia.justificantePlanAsi,
                asistencia.inasistenciaPlanAsi,
                asistencia.fechaDiaPlanAsi,
                docentes.id AS docentes_id,
                g.idGrad AS grados_idGrad,
                estudiantes.idEst AS estudiantes_idEst,
                CONCAT(pd.nombrePers, ' ', pd.apellidoPers) AS Docente,
                CONCAT(pe.nombrePers, ' ', pe.apellidoPers) AS Estudiante,
                g.numerogradoGrad AS NumeroDeGrado,
                division.nombreDivisionDivi AS NombreDivision,
                turno.horaTurno AS TurnoDivision
                FROM
                    asistencia
                JOIN docentes ON asistencia.docentes_id = docentes.id
                JOIN personas AS pd ON docentes.personas_Pers_id = pd.idPers
                JOIN estudiantes ON asistencia.estudiantes_idEst = estudiantes.idEst
                JOIN personas AS pe ON estudiantes.personas_Pers_id = pe.idPers
                JOIN grados AS g ON asistencia.grados_idGrad = g.idGrad
                JOIN resgistroturnodivision ON g.resgistroturnodivision_Reg_TurnoDivi_id = resgistroturnodivision.idRegTurnoDivi
                JOIN division ON resgistroturnodivision.Division_Divi_id = division.idDivi
                JOIN turno ON resgistroturnodivision.turno_Turno_id = turno.idTurno
                WHERE
                    asistencia.EliminacionLogPlanAsi = 'A' ORDER BY asistencia.idPlanAsi ASC ";
                $resultado = mysqli_query($Bd, $query);


                // Comprobar si hay resultados
                if (mysqli_num_rows($resultado) > 0) {
                ?>
                    <div class="tabla-datos">
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Tardanza</th>
                                <th>Justificante</th>
                                <th>Inasistencia</th>
                                <th>Fecha</th>
                                <th>Docente</th>
                                <th>Estudiante</th>
                                <th>Número de Grado</th>
                                <th>Nombre de División</th>
                                <th>Turno</th>
                                <th>Acciones</th>
                            </tr>
                            <?php
                            // Iterate through each attendance record
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                            ?>
                                <tr>
                                    <td><?php echo $fila['idPlanAsi']; ?></td>
                                    <td><?php echo $fila['tardanzaPlanAsi']; ?></td>
                                    <td><?php echo $fila['justificantePlanAsi']; ?></td>
                                    <td><?php echo $fila['inasistenciaPlanAsi']; ?></td>
                                    <td><?php echo $fila['fechaDiaPlanAsi']; ?></td>
                                    <td><?php echo $fila['Docente']; ?></td>
                                    <td><?php echo $fila['Estudiante']; ?></td>
                                    <td><?php echo $fila['NumeroDeGrado']; ?></td>
                                    <td><?php echo $fila['NombreDivision']; ?></td>
                                    <td><?php echo $fila['TurnoDivision']; ?></td>
                                    <td>
                                        <form action="./modificarPlanillaAsistencia.php" method="GET" style="display:inline">
                                            <input type="hidden" name="usuario" value="<?php echo $usuarioUser; ?>">
                                            <input type="hidden" name="idPlanilla" value="<?php echo $fila['idPlanAsi']; ?>">
                                            <input type="hidden" name="idDocente" value="<?php echo $fila['docentes_id']; ?>">
                                            <input type="hidden" name="idGrados" value="<?php echo $fila['grados_idGrad']; ?>">
                                            <input type="hidden" name="idEstudiante" value="<?php echo $fila['estudiantes_idEst']; ?>">
                                            <button type="submit" class="boton-amarillo-block">
                                                <img class="boton-pa" src="./Style/Images/modificarDatos.png" alt="">
                                            </button>
                                        </form>
                                        <form action="./eliminarPlanillaAsistencia.php" method="GET" style="display:inline">
                                            <input type="hidden" name="usuario" value="<?php echo $usuarioUser; ?>">
                                            <input type="hidden" name="idPlanilla" value="<?php echo $fila['idPlanAsi']; ?>">
                                            <input type="hidden" name="idDocente" value="<?php echo $fila['docentes_id']; ?>">
                                            <input type="hidden" name="idGrados" value="<?php echo $fila['grados_idGrad']; ?>">
                                            <input type="hidden" name="idEstudiante" value="<?php echo $fila['estudiantes_idEst']; ?>">
                                            <button type="submit" class="boton-amarillo-block">
                                                <img class="boton-pa" src="./Style/Images/EliminarDato.png" alt="">
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                <?php
                } else {
                    // If no attendance records found
                    echo "No se encontraron datos.";
                }
                ?>
                <form action="./crearPlanillaAsistencia.php" method="GET">
                    <input type="hidden" name="usuario" value="<?php echo $usuarioUser; ?>">
                    <input class="boton-enviar" type="submit" value="Registrar Asistencia">
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