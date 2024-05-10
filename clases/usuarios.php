<?php

require './includes/conexion.php';

$bd = conectarBD();

class Usuario {
    public $usu_user;	
	protected $usu_contrasenia;
	protected $usu_pinolvido;
	public $usu_estadorol;
	public $preRol_PreestablecerRol_id;

    public function __construct($usu_user, $usu_contrasenia, $usu_pinolvido, $usu_estadorol, $preRol_PreestablecerRol_id) {
        $this->usu_user = $usu_user;
        $this->usu_contrasenia = $usu_contrasenia;
        $this->usu_pinolvido = $usu_pinolvido;
        $this->usu_estadorol = $usu_estadorol;
        $this->preRol_PreestablecerRol_id = $preRol_PreestablecerRol_id;
    }
}