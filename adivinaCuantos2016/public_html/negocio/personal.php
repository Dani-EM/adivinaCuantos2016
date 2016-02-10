<?php
	class CPersonal
	{
		/*--------------------------*/
		/* Propiedades Privadas 	*/
		/*--------------------------*/
		private $idPersonal;
		private $nombre;
		/*----------------*/
		
		/*--------------------------*/
		/* Propiedades Públicas 	*/
		/*--------------------------*/
		public function setNombre($value)
		{
			$this->nombre = $value;
		}
		
		public function getNombre()
		{
			return $this->nombre;
		}
		/*----------------*/
		
		/*--------------------------*/
		/* Constructores		 	*/
		/*--------------------------*/
		 public function __construct()
		{
			$this->idPersonal = 0;
		}
		
		/*----------------*/
		
		/*--------------------------*/
		/* Métodos 					*/
		/*--------------------------*/
		
		
		
		/*----------------*/
	}
?>