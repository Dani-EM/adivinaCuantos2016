<?php
	class CUsuario
	{
		/*--------------------------*/
		/* Propiedades Privadas 	*/
		/*--------------------------*/
		private $idUsuario;
		private $nick;
		private $email;
		private $password;
                private $haPagado;
		/*----------------*/
		
		/*--------------------------*/
		/* Propiedades Públicas 	*/
		/*--------------------------*/
                public function setIdUsuario($value)
		{
			$this->idUsuario = $value;
		}
		public function setNick($value)
		{
			$this->nick = $value;
		}
		public function setEmail($value)
		{
			$this->email = $value;
		}
		public function setPassword($value)
		{
			$this->password = $value;
		}
                public function setHaPagado($value)
		{
			$this->haPagado = $value;
		}
                
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}
		public function getNick()
		{
			return $this->nick;
		}
		public function getEmail()
		{
			return $this->email;
		}
		public function getPassword()
		{
			return $this->password;
		}
                public function getHaPagado()
		{
			return $this->haPagado;
		}
		/*----------------*/
		
		/*--------------------------*/
		/* Constructores		 	*/
		/*--------------------------*/
		 public function __construct()
		{
			$this->idUsuario = 0;
                        $this->haPagado = FALSE;
		}
		
		/*----------------*/
		
		/*--------------------------*/
		/* Métodos Grabación        */
		/*--------------------------*/
		
                public function graba($con){
                     mysqli_query($con,"INSERT INTO usuarios (nick, email, password, haPagado) 
                    VALUES ('".$this->nick."', '".$this->email."','".$this->password."',".$this->haPagado.")");

                }

                /*--------------------------*/
		/* Métodos Recuperación     */
		/*--------------------------*/
		
                public static function dameUsuario($con,$emailUsuario){

                    $result = mysqli_query($con,"SELECT * FROM usuarios
                    WHERE email='".$emailUsuario."'");

                    $usuario = new CUsuario();
                    while($row = mysqli_fetch_array($result))
                    {
                        $usuario->setIdUsuario($row['idUsuario']);
                        $usuario->setEmail($row['email']);
                        $usuario->setHaPagado($row['haPagado']);
                    }
                    
                    return $usuario;
                }


                /*----------------*/
	}
?>