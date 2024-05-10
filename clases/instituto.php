<?php
require './includes/conexion.php';

$bd= conectarBD();

class Institucion{
    public $Inst_nombrecolegio;
    public $Inst_numerocolegio;
    public $Inst_link;
    public $Inst_Correo;
    public $Inst_telefono;
    public $admin_Adm_id;
    public $domicilio_Doc_id;

    public function __construct($Inst_nombrecolegio, $Inst_numerocolegio, $Inst_link, $Inst_Correo, $Inst_telefono, $admin_Adm_id, $domicilio_Doc_id) {
        $this->Inst_nombrecolegio = $Inst_nombrecolegio;
        $this->Inst_numerocolegio = $Inst_numerocolegio;
        $this->Inst_link = $Inst_link;
        $this->Inst_Correo = $Inst_Correo;
        $this->Inst_telefono = $Inst_telefono;
        $this->admin_Adm_id = $admin_Adm_id;
        $this->domicilio_Doc_id = $domicilio_Doc_id;
    }
}