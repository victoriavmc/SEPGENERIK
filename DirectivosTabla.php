<?php
include './pagInicialArriba.php';
?>

<div class='ladoDere70'>
    <div class='usarDisenio'>
        <div class="fondoDerechoCrud">
            <div class="crudDerecho">
                <div class='TituloCrud'>
                    <h1>Datos de Directivos</h1>
                </div>
                <?php

                $Bd = conexionBaseDatos();
                $query = "SELECT d.id, p.nombrePers, p.apellidoPers, p.fechanacimientoPers, p.cuilPers, p.sexoPers, p.nacionalidadPers, p.provinciaPers, p.dniPers, u.userUsu, u.estadorolUsu, preRol.nombreRol, dom.BarrioDom, dom.CalleDom, dom.AlturaDom, c.correoCont, c.telefonoCont FROM directivos d JOIN personas p ON d.personas_Pers_id = p.idPers JOIN usuario u ON d.usuario_Usu_Id = u.IdUsu JOIN preestablecerrol preRol ON u.PreestablecerRol_PreestablecerRol_id = preRol.idPreRol JOIN domicilio dom ON dom.personas_Pers_id = p.idPers JOIN contacto c ON c.personas_Pers_id = p.idPers WHERE d.EliminacionLogDir = 'A'";
                $resultado = mysqli_query($Bd, $query);

                // Comprobar si hay resultados
                if ($resultado && mysqli_num_rows($resultado) > 0) {
                ?>
                    <div class="tabla-datos">
                        <table>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Fecha de Nacimiento</th>
                                <th>CUIL</th>
                                <th>Sexo</th>
                                <th>Nacionalidad</th>
                                <th>Provincia</th>
                                <th>DNI</th>
                                <th>Usuario</th>
                                <th>Estado Rol</th>
                                <th>PreRol</th>
                                <th>Barrio</th>
                                <th>Calle</th>
                                <th>Altura</th>
                                <th>Correo de Contacto</th>
                                <th>Teléfono de Contacto</th>
                            </tr>
                            <?php
                            // Iterar sobre los resultados y mostrarlos en la tabla
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                            ?>
                                <tr>
                                    <td><?php echo $fila['nombrePers']; ?></td>
                                    <td><?php echo $fila['apellidoPers']; ?></td>
                                    <td><?php echo $fila['fechanacimientoPers']; ?></td>
                                    <td><?php echo $fila['cuilPers']; ?></td>
                                    <td><?php echo $fila['sexoPers']; ?></td>
                                    <td><?php echo $fila['nacionalidadPers']; ?></td>
                                    <td><?php echo $fila['provinciaPers']; ?></td>
                                    <td><?php echo $fila['dniPers']; ?></td>
                                    <td><?php echo $fila['userUsu']; ?></td>
                                    <td><?php echo $fila['estadorolUsu']; ?></td>
                                    <td><?php echo $fila['nombreRol']; ?></td>
                                    <td><?php echo $fila['BarrioDom']; ?></td>
                                    <td><?php echo $fila['CalleDom']; ?></td>
                                    <td><?php echo $fila['AlturaDom']; ?></td>
                                    <td><?php echo $fila['correoCont']; ?></td>
                                    <td><?php echo $fila['telefonoCont']; ?></td>
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