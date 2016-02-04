<?php

	include_once (__DIR__.'/scripts/bd/consultas.php');

	class usuario{
		protected $nombre;
		protected $apellidoP;
		protected $apellidoM;
		protected $rut;
		protected $idAsignatura;
		protected $correo;
		protected $password;
		protected $tipoUsuario;


		//constructor login
		public function __construct($rut, $password){
			$this->rut = $rut;
			$this->password = $password;
		}

		//TODO constructor con los datos cargados desde un array

		public function login(){
			consultas::verificarLogin($this->rut, $this->password);
		}

		public function logout(){

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
		public function __get($var){
			if(property_exists('usuario', $var)){
				return $this->$var;
			}else{
				return NULL;
			}
		}



	}
?>