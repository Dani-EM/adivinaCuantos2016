<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CEdicion_Evento
 *
 * @author descoriza
 */
class CEdicion_Evento {
    /*--------------------------*/
    /* Propiedades Privadas 	*/
    /*--------------------------*/
    private $idEdicionEvento;
    private $descripcion;
    private $anyo;
    private $nEvento;
    /*----------------*/

    /*--------------------------*/
    /* Propiedades Públicas 	*/
    /*--------------------------*/
    public function setIdEdicionEvento($value)
    {
            $this->idEdicionEvento = $value;
    }
    public function setDescripcion($value)
    {
            $this->descripcion = $value;
    }
    public function setAnyo($value)
    {
            $this->anyo = $value;
    }
    public function setNEvento($value)
    {
            $this->nEvento = $value;
    }
   
    /*---------------*/
    public function getIdEdicionEvento()
    {
            return $this->idEdicionEvento;
    }
    public function getDescripcion()
    {
            return $this->descripcion;
    }
    public function getAnyo()
    {
            return $this->anyo;
    }
    public function getNEvento()
    {
            return $this->nEvento;
    }
    
    /*----------------*/

    /*--------------------------*/
    /* Constructores		 	*/
    /*--------------------------*/
     public function __construct()
    {
        $this->idEdicionEvento = 0;
    }

    /*----------------*/

    /*--------------------------*/
    /* Métodos Grabación        */
    /*--------------------------*/

    public function graba($con){

        if (($stmt = $con->prepare("INSERT INTO ediciones_eventos (descripcion, anyo, nEvento) VALUES (?, ?, ?)"))==true){
            $stmt->bind_param('sii', $this->descripcion, $this->anyo, $this->nEvento);
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

    public static function dameEdicionEventos($con,$idEdicionEvento=NULL,$descripcion=NULL,$anyo=NULL,$nEvento=NULL){
        $eventos = array();
        
        $sql = "SELECT * FROM ediciones_eventos WHERE 1=1";
        
        if ($idEdicionEvento) {
        $sql .= " AND idEdicionEvento=".$idEdicionEvento;
        }
        if ($descripcion) {
            $sql .= " AND descripcion='".$descripcion."'";
        }
        if ($anyo) {
            $sql .= " AND anyo=".$anyo;
        }
        if ($nEvento) {
            $sql .= " AND nEvento=".$nEvento;
        }
       
        $result = mysqli_query($con, $sql);
        
        while($row = mysqli_fetch_array($result))
        {
            $evento = new CEdicionEvento();
            $evento->setIdEdicionEvento($row['idEdicionEvento']);
            $evento->setIdTmdb($row['descripcion']);
            $evento->setTituloEdicionEvento($row['anyo']);
            $evento->setNEvento($row['nEvento']);
            array_push($eventos, $evento);
        }
         
         return $eventos;

    }


    /*----------------*/
}
