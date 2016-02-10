<?php
	class CVotacion
	{
		/*--------------------------*/
		/* Propiedades Privadas 	*/
		/*--------------------------*/
		private $idVotacion;
		private $idUsuario;
		private $idNominacion;
		private $puntuacion;
		/*----------------*/
		
		/*--------------------------*/
		/* Propiedades Públicas 	*/
		/*--------------------------*/
		public function setIdUsuario($value)
		{
			$this->idUsuario = $value;
		}
		public function setidNominacion($value)
		{
			$this->idNominacion = $value;
		}
		public function setPuntuacion($value)
		{
			$this->puntuacion = $value;
		}
		
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}
		public function getIdNominacion()
		{
			return $this->idNominacion;
		}
		public function getPuntuacion()
		{
			return $this->puntuacion;
		}
		/*----------------*/
		
		/*--------------------------*/
		/* Constructores		 	*/
		/*--------------------------*/
		 public function __construct()
		{
			$this->idVotacion = 0;
		}
		
		/*----------------*/
		
		/*--------------------------*/
		/* Métodos 					*/
		/*--------------------------*/
		
		
		
		/*----------------*/
	}
?>