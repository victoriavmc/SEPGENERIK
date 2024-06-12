<?php
include './Logic/PHP/msjPredeterminado.php';

function correoSend($correo, $pinOlvido, $usuario)
{
    // Configura los encabezados del correo
    $to = $correo;
    $subject = "Recuperar contraseña";
    $message = "Hola $usuario,\n\nSu pin de recuperación es: $pinOlvido\n\nGracias.";
    $headers = 'From: testingcodevictoriavmc@gmail.com' . "\r\n" . 'Reply-To: victoriavmcSEPGENERIK@gmail.com';

    // Envío del correo electrónico
    if (mail($to, $subject, $message, $headers)) {
        echo mensajePredeterminado(0, 'enviar', 'el Pin de Olvido');
    } else {
        echo mensajePredeterminado(1, 'enviar', 'el Pin de Olvido');
    }
}

function crearNuevoPin($idUsuario, $correo, $usuario)
{
    // Generar un nuevo PIN de olvido
    $codigoAleatorio = substr(str_shuffle(str_repeat('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', 6)), 0, 6);

    // Establecer la conexión a la base de datos
    $Bd = conexionBaseDatos();

    // Actualizar el PIN de olvido en la base de datos
    $query = "UPDATE usuario SET pinolvidoUsu = '$codigoAleatorio' WHERE IdUsu = '$idUsuario'";
    $resultado = mysqli_query($Bd, $query);

    if ($resultado) {
        // Asignar el nuevo PIN de olvido a la sesión
        $_SESSION['pinOlvido'] = $codigoAleatorio;

        // Enviar el correo electrónico con el PIN de olvido
        $subject = "Recuperación de contraseña";
        $message = "Hola $usuario,\n\nSu nuevo PIN de recuperación es: $codigoAleatorio\n\nGracias.";
        $headers = 'From: testingcodevictoriavmc@gmail.com' . "\r\n" .
            'Reply-To: victoriavmcSEPGENERIK@gmail.com';

        if (mail($correo, $subject, $message, $headers)) {
            echo "Correo enviado exitosamente a $correo";
        } else {
            echo "Error al enviar el correo a $correo";
        }
    } else {
        echo "Error al actualizar el PIN en la base de datos.";
    }
}
