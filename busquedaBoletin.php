<?php
$IDINGRESADO = $_GET['cuilinput'];

function enviarBoletin($IDINGRESADO, $Bd)
{
    $seleccionEstudiante = "SELECT bolentin.idboletin,
                                bolentin.CantidadFaltasxTrimestre,
                                CONCAT(
                                    grados.numerogradoGrad,
                                    ' - ',
                                    d.nombreDivisionDivi,
                                    ' - ',
                                    t.horaTurno
                                ) AS Grado,
                                materias.nombreMateriaMat,
                                libreta.NOTAFINAL,
                                CONCAT(personas.nombrePers,' ', personas.apellidoPers) AS Estudiante,
                                personas.cuilPers,
                                estudiantes.idEst
                            FROM
                                boletin
                            JOIN libreta ON bolentin.libreta_idLibreta = libreta.idLibreta
                            JOIN matricularestudiante ON libreta.matricularestudiante_idMatricEst = matricularestudiante.idMatricEst
                            JOIN estudiantes ON matricularestudiante.estudiantes_Est_id = estudiantes.idEst
                            JOIN personas ON estudiantes.personas_Pers_id = personas.idPers
                            JOIN grados ON libreta.grados_idGrad = grados.idGrad
                            JOIN materias ON grados.materias_Mat_id = materias.MatidMat
                            JOIN resgistroturnodivision AS rTD ON rTD.idRegTurnoDivi = grados.resgistroturnodivision_Reg_TurnoDivi_id
                            JOIN division AS d ON rTD.Division_Divi_id = d.idDivi
                            JOIN turno AS t ON rTD.turno_Turno_id = t.idTurno 
                            WHERE bolentin.EliminacionLogicaBole='A' AND personas.cuilPers = $IDINGRESADO
                            GROUP BY materias.nombreMateriaMat, personas.nombrePers, personas.apellidoPers  
                            ORDER BY Estudiante ASC";


    $Enviartutores = "SELECT contacto.correoCont
     FROM tutores
     JOIN tutor ON tutores.tutor_Tutor_id = tutor.idTutor
     JOIN personas AS pt ON tutor.personas_Pers_id = pt.idPers
     JOIN contacto ON contacto.personas_Pers_id = pt.idPers
     JOIN estudiantes ON tutores.estudiantes_Est_id = estudiantes.idEst
     WHERE estudiantes.idEst = $IDRECUPERADO and estudiantes.EliminacionLogEst = 'A' and tutor.EliminacionLogiTutor='A';";

    // Prepare message
    $message = "Hola sr/a tutor,\nEn este correo informativo puede visualizar el boletín de su hijo/a:\n";

    // Append report card information to the message
    while ($row = $resultado->fetch_assoc()) {
        $message .= "Grado: " . $row['Grado'] . "\n";
        $message .= "Materia: " . $row['nombreMateriaMat'] . "\n";
        $message .= "Nota Final: " . $row['NOTAFINAL'] . "\n";
        $message .= "Estudiante: " . $row['Estudiante'] . "\n\n";
    }

    $message .= "\nGracias.";

    // Set email headers
    $headers = 'From: testingcodevictoriavmc@gmail.com' . "\r\n" . 'Reply-To: victoriavmcSEPGENERIK@gmail.com';

    // Send email
    if (mail($correo, "BOLETIN!", $message, $headers)) {
        echo mensajePredeterminado(0, 'enviar', 'el Pin de Olvido');
    } else {
        echo mensajePredeterminado(1, 'enviar', 'el Pin de Olvido');
    }

    // Close statement
    $stmt->close();
}

// $seleccionEstudiante = "SELECT bolentin.idboletin,
//                     bolentin.CantidadFaltasxTrimestre,
//                     CONCAT(
//                         grados.numerogradoGrad,
//                         ' - ',
//                         d.nombreDivisionDivi,
//                         ' - ',
//                         t.horaTurno
//                     ) AS Grado,
//                     materias.nombreMateriaMat,
//                     libreta.NOTAFINAL,
//                     CONCAT(personas.nombrePers,' ', personas.apellidoPers) AS Estudiante,
//                     personas.cuilPers,
//                     estudiantes.idEst
//                 FROM
//                     bolentin
//                 JOIN libreta ON bolentin.libreta_idLibreta = libreta.idLibreta
//                 JOIN matricularestudiante ON libreta.matricularestudiante_idMatricEst = matricularestudiante.idMatricEst
//                 JOIN estudiantes ON matricularestudiante.estudiantes_Est_id = estudiantes.idEst
//                 JOIN personas ON estudiantes.personas_Pers_id = personas.idPers
//                 JOIN grados ON libreta.grados_idGrad = grados.idGrad
//                 JOIN materias ON grados.materias_Mat_id = materias.MatidMat
//                 JOIN resgistroturnodivision AS rTD ON rTD.idRegTurnoDivi = grados.resgistroturnodivision_Reg_TurnoDivi_id
//                 JOIN division AS d ON rTD.Division_Divi_id = d.idDivi
//                 JOIN turno AS t ON rTD.turno_Turno_id = t.idTurno 
//                 WHERE bolentin.EliminacionLogicaBole='A' AND personas.cuilPers = $IDINGRESADO
//                 GROUP BY materias.nombreMateriaMat, personas.nombrePers, personas.apellidoPers  
//                 ORDER BY `Estudiante` ASC";


// $resultado = mysqli_query($Bd, $seleccionEstudiante);
// if ($resultado && mysqli_num_rows($resultado) > 0) {


//     $Enviartutores = "SELECT contacto.correoCont
//     FROM tutores
//     JOIN tutor ON tutores.tutor_Tutor_id = tutor.idTutor
//     JOIN personas AS pt ON tutor.personas_Pers_id = pt.idPers
//     JOIN contacto ON contacto.personas_Pers_id = pt.idPers
//     JOIN estudiantes ON tutores.estudiantes_Est_id = estudiantes.idEst
//     WHERE estudiantes.idEst = $IDRECUPERADO and estudiantes.EliminacionLogEst = 'A' and tutor.EliminacionLogiTutor='A';";
// }
