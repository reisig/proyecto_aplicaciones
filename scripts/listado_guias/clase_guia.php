<?php
	class Guia{
			
		private $id;
		private $titulo;
		private $descripcion;
		private $fecha;
		private $id_asignatura;
		private $estado;
		private $cantPreguntas = 0;
		
		
		public function __construct($id,$titulo,$descripcion,$fecha,$id_asignatura,$estado){
			
			$this->id = $id;
			$this->titulo = $titulo;
			$this->descripcion = $descripcion;
			$this->fecha = $fecha;
			$this->id_asignatura = $id_asignatura;
			$this->estado = $estado;
		}
		
		public function setId($id){$this->id = $id;}
		public function setTitulo($titulo){$this->titulo = $titulo;}
		public function setDescripcion($descripcion){$this->descripcion = $descripcion;}
		public function setFecha($fecha){$this->fecha = $fecha;}
		public function setId_asignatura($id_asignatura){$this->id_asignatura = $id_asignatura;}
		public function setEstado($estado){$this->estado = $estado;}
		public function setCantPreguntas($cantPreguntas){$this->cantPreguntas = $cantPreguntas;}
		
		public function getId(){return $this->id;}
		public function getTitulo(){return $this->titulo;}
		public function getDescripcion(){return $this->descripcion;}
		public function getFecha(){return $this->fecha;}
		public function getId_asignatura(){return $this->id_asignatura;}
		public function getEstado(){return $this->estado;}
		public function getCantPreguntas(){return $this->cantPreguntas;}
	}
?>