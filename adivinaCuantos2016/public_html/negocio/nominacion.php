<?php
	class CNominacion
	{
		private $number;
	 
		public function setNumber()
		{
			$this->number = 5;
		}
	 
		public function area()
		{
			return $this->number * $this->number;
		}
	}
?>