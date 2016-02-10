<?php
	class CCategoria
	{
		/*--------------------------*/
		/* Propiedades Privadas 	*/
		/*--------------------------*/
		private $idCategoria;
		private $descripcion;
		/*----------------*/
		
		/*--------------------------*/
		/* Propiedades Públicas 	*/
		/*--------------------------*/
		public function setDescripcion($value)
		{
			$this->descripcion = $value;
		}
		
		public function getDescripcion()
		{
			return $this->descripcion;
		}
		/*----------------*/
		
		/*--------------------------*/
		/* Constructores		 	*/
		/*--------------------------*/
		 public function __construct()
		{
			$this->idCategoria = 0;
		}
		
		/*----------------*/
		
		/*--------------------------*/
		/* Métodos 					*/
		/*--------------------------*/
		
		
		
		/*----------------*/
	}
?>