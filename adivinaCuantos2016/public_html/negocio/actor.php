<?php
	class CActor
	{
		/*--------------------------*/
		/* Propiedades Privadas 	*/
		/*--------------------------*/
		private $idActor;
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
			$this->idActor = 0;
		}
		
		/*----------------*/
		
		/*--------------------------*/
		/* Métodos 					*/
		/*--------------------------*/
		
		
		
		/*----------------*/
	}
?>