<?php
	class CDirector
	{
		/*--------------------------*/
		/* Propiedades Privadas 	*/
		/*--------------------------*/
		private $idDirector;
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
			$this->idDirector = 0;
		}
		
		/*----------------*/
		
		/*--------------------------*/
		/* Métodos 					*/
		/*--------------------------*/
		
		
		
		/*----------------*/
	}
?>