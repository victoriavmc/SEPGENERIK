<?php
include './pagInicialArriba.php';
include './Logic/PHP/enviarCorreo.php';

$Bd = conexionBaseDatos();

$query = "SELECT u.IdUsu, u.userUsu, a.correoAdm, u.pinolvidoUsu 
FROM usuario AS u
JOIN admin AS a ON u.IdUsu = a.usuario_Usu_Id
WHERE u.IdUsu = $id AND u.eliminacionLogUsu = 'A'";
$resultado = mysqli_query($Bd, $query);
$admin = mysqli_fetch_assoc($resultado);

$idUsu = $admin['IdUsu'];
$usuario = $admin['userUsu'];
$correo = $admin['correoAdm'];
$pinOlvido = $admin['pinolvidoUsu']; //ENVIARSE AL CORREO

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['modificar'])) {
        $usuarioInput = $_POST['usuario'];
        $correoInput = $_POST['correo'];

        $query = "CALL ActualizarAdmin($idUsu, '$usuarioInput', '$correoInput')";
        $resultado = mysqli_query($Bd, $query);

        // header('Location: ./pagModificarDatosADMIN.php');
    } elseif (isset($_POST['enviarAlCorreo'])) {
        correoSend($correo, $pinOlvido, $usuario);
    }
}
?>
<div class='ladoDere70'>
    <div class='usarDisenio'>
        <div class="fondoDerechoCrud">
            <div class="crudDerecho">
                <div class='TituloCrud'>
                    <h1>Modificar Usuario</h1>
                </div>
                <div class='modeloCrudSelect'>
                    <form class="formulario-admin" method="POST">
                        <input type="hidden" name="idUsu" value="<?php echo $idUsu; ?>">

                        <label for="usuario">Usuario:</label>
                        <input type="text" id="usuario" name="usuario" value="<?php echo $usuario; ?>" required><br>

                        <label for="correo">Correo:</label>
                        <input type="email" id="correo" name="correo" value="<?php echo $correo; ?>" required><br>

                        <div class="envioCorreo">
                            <div class="pin-olvido">
                                <label for="pinOlvido">PIN de Olvido:</label>
                                <input type="password" id="pinOlvido" name="pinOlvido" value="<?php echo $pinOlvido; ?>" disabled><br>
                            </div>

                            <div>
                                <button type="submit" name="enviarAlCorreo" class="enviar-correo"><img class="imagen-correo" src="../Style/Images/enviarCorreo.png" alt="">Enviar al correo electrónico</button>
                            </div>
                        </div>
                        <input class="boton-enviar" type="submit" name="modificar" value="Modificar">
                    </form>
                </div>
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