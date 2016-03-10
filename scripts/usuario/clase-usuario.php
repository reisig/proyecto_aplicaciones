<?php

	include_once (__DIR__.'/scripts/bd/consultas.php');

	class usuario{

		public $nombre;
		public $apellidoP;
		public $apellidoM;
		public $rut;
		public $idAsignatura;
		public $correo;
		public $password;
		public $tipoUsuario;
		public static $instance;


		//constructor login
		public function __construct($rut){
			$datos = consultas::getUsuario($rut);
			if($datos){
				$this->nombre = $datos['Nombre'];
				$this->apellidoP = $datos['ApellidoP'];
				$this->apellidoM = $datos['ApellidoM'];
				$this->rut = $rut;
				$this->correo = $datos['Correo'];
				$this->password = $datos['Password'];
				$this->tipoUsuario = $datos['TipoUsuario'];
				self::$instance = $this;
			}
		}

		public function __construct1(){
			self::$instance = $this;			
		}


		public function __construct2($nombre, $apellidoP, $apellidoM, $rut, $correo, $password, $tipoUsuario){
			$this->nombre = $nombre;
			$this->apellidoP = $apellidoP;
			$this->apellidoM = $apellidoM;
			$this->rut = $rut;
			$this->correo = $correo;
			$this->password = $password;
			$this->tipoUsuario = $tipoUsuario;

			self::$instance = $this;
		}

		//TODO constructor con los datos cargados desde un array

		public function login(){
			consultas::verificarLogin($this->rut, $this->password);
		}

		public function logout(){
			self::$instance = null;
		}

		/*
		*	funcion set
		*	recibe la variable a setear,
		*	y el valor de esta variable
		*
		*/
		public function __set($variable, $valor){
			if(property_exists('usuario', $variable)){
				$this->$variable = $valor;
			}
		}

		/*
		*
		*
		*
		*/

		public static function getInstance(){
     		if (!is_null(self::$instance)) return self::$instance;
     		self::$instance = new self;
     		return self::$instance;
   		}


		public function __get($var){
			if(property_exists('usuario', $var)){
				return $this->$var;
			}else{
				return NULL;
			}
		}



	}
?>