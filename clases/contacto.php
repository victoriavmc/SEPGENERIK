<?php
require './includes/conexion.php';
$bd = conectarBD();

class Contacto
{
    public $Cont_correo;
    public $Cont_telefono;
    public $personas_Pers_id;

    public function __construct($Cont_correo, $Cont_telefono, $personas_Pers_id)
    {
        $this->Cont_correo = $Cont_correo;
        $this->Cont_telefono = $Cont_telefono;
        $this->personas_Pers_id = $personas_Pers_id;
    }
}
