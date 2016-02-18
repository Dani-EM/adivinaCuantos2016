<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CPuntuacion
 *
 * @author descoriza
 */
class CVotacion {
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
    public function setIdVotacion($value)
    {
            $this->idVotacion = $value;
    }
    public function setIdUsuario($value)
    {
            $this->idUsuario = $value;
    }
    public function setIdNominacion($value)
    {
            $this->idNominacion = $value;
    }
    public function setPuntuacion($value)
    {
            $this->puntuacion = $value;
    }
   
    /*---------------*/
    public function getIdVotacion()
    {
            return $this->idPuntuacion;
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
        $this->idPuntuacion = 0;
    }

    /*----------------*/

    /*--------------------------*/
    /* Métodos Grabación        */
    /*--------------------------*/

    public function graba($con){

        if (($stmt = $con->prepare("INSERT INTO votaciones (idUsuario, idNominacion, puntuacion) VALUES (?, ?, ?)"))==true){
            $stmt->bind_param('iii', $this->idUsuario, $this->idNominacion, $this->puntuacion);
            $stmt->execute();

            return $stmt->affected_rows;
             
         }
         /*else{
             die ("Mysql Error: " . $con->error);
             
         }
        */

        
    }

    /*--------------------------*/
    /* Métodos Recuperación     */
    /*--------------------------*/

    public static function dameVotaciones($con,$idVotacion=NULL,$idUsuario=NULL,$idNominacion=NULL,$puntuacion=NULL){
        $votaciones = array();
        
        $sql = "SELECT * FROM votaciones WHERE 1=1";
        
        if ($idVotacion) {
            $sql .= " AND idVotacion=".$idVotacion;
        }
        if ($idUsuario) {
            $sql .= " AND idUsuario=".$idUsuario;
        }
        if ($idNominacion) {
            $sql .= " AND idNominacion=".$idNominacion;
        }
        if ($puntuacion) {
            $sql .= " AND puntuacion=".$puntuacion;
        }
       
        $result = mysqli_query($con, $sql);
        
        while($row = mysqli_fetch_array($result))
        {
            $votacion = new CVotacion();
            $votacion->setIdVotacion($row['idVotacion']);
            $votacion->setIdUsuario($row['idUsuario']);
            $votacion->setIdNominacion($row['idNominacion']);
            $votacion->setPuntuacion($row['puntuacion']);
            array_push($votaciones, $votacion);
        }
         
         return $votaciones;

    }

}
