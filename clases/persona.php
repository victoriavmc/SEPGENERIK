<?php
require './includes/conexion.php';
$bd = conectarBD();

// Crear una tabla de personas
class Persona
{
    public $Pers_nombre;
    public $Pers_apellido;
    public $Pers_fechanacimiento;
    public $Pers_cuil;
    public $Pers_sexo;
    public $Pers_nacionalidad;
    public $Pers_provincia;
    public $Pers_dni;

    public function __construct($Pers_nombre, $Pers_apellido, $Pers_fechanacimiento, $Pers_cuil, $Pers_sexo, $Pers_nacionalidad, $Pers_provincia, $Pers_dni)
    {
        $this->Pers_nombre = $Pers_nombre;
        $this->Pers_apellido = $Pers_apellido;
        $this->Pers_fechanacimiento = $Pers_fechanacimiento;
        $this->Pers_cuil = $Pers_cuil;
        $this->Pers_sexo = $Pers_sexo;
        $this->Pers_nacionalidad = $Pers_nacionalidad;
        $this->Pers_provincia = $Pers_provincia;
        $this->Pers_dni = $Pers_dni;
    }
}
