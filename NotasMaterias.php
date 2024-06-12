<?php
include './pagInicialArriba.php';
?>

<div class='ladoDere70'>
    <div class='usarDisenio'>
        <div class="fondoDerechoCrud">
            <div class="crudDerecho">
                <div class='TituloCrud'>
                    <h1>Notas</h1>
                </div>
                <?php
                $Bd = conexionBaseDatos();
                $query = "SELECT DISTINCT
    registrodeplanillasdocente.grados_Grad_id AS Grado,
    materias.nombreMateriaMat AS Materia,
    CONCAT(
        personas_docente.nombrePers,
        ' ',
        personas_docente.apellidoPers
    ) AS NombreDocente,
    CONCAT(
        personas_estudiante.nombrePers,
        ' ',
        personas_estudiante.apellidoPers
    ) AS NombreEstudiante,
    valornotaCalf AS Nota,
    fecharindeCalf AS FechaExamen,
    trimestre.nombretrimestreTri AS Trimestre,
    preestablecerexamen.nombreExamen AS NombreExamen
    FROM examenescalificados
    JOIN registrodeplanillasdocente ON examenescalificados.registrodeplanillasdocente_Reg_Pla_Doc_Id = registrodeplanillasdocente.IdRegPlaDoc
    JOIN calificacionexamen ON examenescalificados.calificacionexamen_Calf_id = calificacionexamen.idCalf
    JOIN matricularestudiante ON examenescalificados.matricularestudiante_Matric_Est_id = matricularestudiante.idMatricEst
    JOIN registrodeplanillaestudiante ON matricularestudiante.idMatricEst = registrodeplanillaestudiante.matricularestudiante_Matric_Est_id
    JOIN docentes ON registrodeplanillasdocente.docentes_Doc_id = docentes.id
    JOIN personas AS personas_docente ON docentes.personas_Pers_id = personas_docente.idPers
    JOIN estudiantes ON matricularestudiante.estudiantes_Est_id = estudiantes.idEst
    JOIN personas AS personas_estudiante ON estudiantes.personas_Pers_id = personas_estudiante.idPers
    JOIN grados ON registrodeplanillasdocente.grados_Grad_id = grados.idGrad
    JOIN materias ON grados.materias_Mat_id = materias.MatidMat
    JOIN trimestre ON examenescalificados.trimestre_Tri_id = trimestre.idTri
    JOIN nombreexamen ON nombreexamen.idExa = examenescalificados.nombreexamen_Exa_id 
    JOIN preestablecerexamen ON preestablecerexamen.IdPreExa = nombreexamen.PreestablecerExamen_PreeExa_Id;";
                $resultado = mysqli_query($Bd, $query);

                // Comprobar si hay resultados
                if (mysqli_num_rows($resultado) > 0) {
                ?>
                    <div class="tabla-datos">
                        <table>
                            <tr>
                                <th>Grado</th>
                                <th>Materia</th>
                                <th>Nombre Docente</th>
                                <th>Nombre Estudiante</th>
                                <th>Nota</th>
                                <th>Fecha Examen</th>
                                <th>Trimestre</th>
                                <th>Nombre Examen</th>
                            </tr>
                            <?php
                            // Iterar sobre los resultados y mostrarlos en la tabla
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                            ?>
                                <tr>
                                    <td><?php echo $fila['Grado']; ?></td>
                                    <td><?php echo $fila['Materia']; ?></td>
                                    <td><?php echo $fila['NombreDocente']; ?></td>
                                    <td><?php echo $fila['NombreEstudiante']; ?></td>
                                    <td><?php echo $fila['Nota']; ?></td>
                                    <td><?php echo $fila['FechaExamen']; ?></td>
                                    <td><?php echo $fila['Trimestre']; ?></td>
                                    <td><?php echo $fila['NombreExamen']; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>

                <?php
                } else {
                    echo "No se encontraron datos.";
                }
                ?>
            </div>
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