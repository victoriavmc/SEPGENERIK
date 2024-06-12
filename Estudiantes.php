<?php
include './pagInicialArriba.php';
?>

<div class='ladoDere70'>
    <div class='usarDisenio'>
        <div class="fondoDerechoCrud">
            <div class="crudDerecho">
                <div class='TituloCrud'>
                    <h1>Datos de Estudiantes</h1>
                </div>
                <?php

                $Bd = conexionBaseDatos();
                $query = "SELECT DISTINCT e.idEst, p.nombrePers, p.apellidoPers, p.fechanacimientoPers, p.cuilPers, p.sexoPers, p.nacionalidadPers, p.provinciaPers, p.dniPers, e.fotocopiadniEst, e.estadoEst, g.numerogradoGrad 
                FROM estudiantes e 
                JOIN personas p ON e.personas_Pers_id = p.idPers 
                JOIN matricularestudiante m ON m.estudiantes_Est_id = e.idEst 
                JOIN registrodeplanillaestudiante rpe ON rpe.matricularestudiante_Matric_Est_id = m.idMatricEst 
                JOIN grados g ON rpe.grados_Grad_id= g.idGrad 
                WHERE e.EliminacionLogEst = 'A'";
                $resultado = mysqli_query($Bd, $query);

                // Comprobar si hay resultados
                if ($resultado && mysqli_num_rows($resultado) > 0) {
                ?>
                    <div class="tabla-datos">
                        <table>
                            <tr>
                                <th>ID Estudiante</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Fecha de Nacimiento</th>
                                <th>CUIL</th>
                                <th>Sexo</th>
                                <th>Nacionalidad</th>
                                <th>Provincia</th>
                                <th>DNI</th>
                                <th>Fotocopia DNI</th>
                                <th>Estado</th>
                                <th>Grado</th>
                            </tr>
                            <?php
                            // Variable para almacenar el último ID de estudiante
                            $last_id = null;
                            // Iterar sobre los resultados y mostrarlos en la tabla
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                // Si el ID del estudiante es diferente al último ID, muestra la fila
                                if ($fila['idEst'] != $last_id) {
                            ?>
                                    <tr>
                                        <td><?php echo $fila['idEst']; ?></td>
                                        <td><?php echo $fila['nombrePers']; ?></td>
                                        <td><?php echo $fila['apellidoPers']; ?></td>
                                        <td><?php echo $fila['fechanacimientoPers']; ?></td>
                                        <td><?php echo $fila['cuilPers']; ?></td>
                                        <td><?php echo $fila['sexoPers']; ?></td>
                                        <td><?php echo $fila['nacionalidadPers']; ?></td>
                                        <td><?php echo $fila['provinciaPers']; ?></td>
                                        <td><?php echo $fila['dniPers']; ?></td>
                                        <td><?php echo $fila['fotocopiadniEst']; ?></td>
                                        <td><?php echo $fila['estadoEst']; ?></td>
                                        <td><?php echo $fila['numerogradoGrad']; ?></td>
                                    </tr>
                            <?php
                                }
                                // Actualizar el último ID de estudiante
                                $last_id = $fila['idEst'];
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