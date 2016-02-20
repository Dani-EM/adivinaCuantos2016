<?php

include("CPelicula.php");
include("CCategoria.php");
include("CProfesional.php");
include("CEdicion_Evento.php");

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CNominacion
 *
 * @author descoriza
 */



class CNominacion {
    /*--------------------------*/
    /* Propiedades Privadas 	*/
    /*--------------------------*/
    private $idNominacion;
    private $idCategoria;
    private $idPelicula;
    private $idProfesional;
    private $idEdicionEvento;
    
    private $pelicula;
    private $profesional;
    private $categoria;
    /*----------------*/

    /*--------------------------*/
    /* Propiedades Públicas 	*/
    /*--------------------------*/
      public function setIdNominacion($value)
    {
            $this->idNominacion = $value;
    }
    public function setIdCategoria($value)
    {
            $this->idCategoria = $value;
    }
    public function setIdPelicula($value)
    {
            $this->idPelicula = $value;
    }
    public function setIdProfesional($value)
    {
            $this->idProfesional = $value;
    }
    public function setIdEdicionEvento($value)
    {
            $this->idEdicionEvento = $value;
    }
    public function setPelicula($value)
    {
            $this->pelicula = $value;
    }
    public function setProfesional($value)
    {
            $this->profesional = $value;
    }
    public function setCategoria($value)
    {
            $this->categoria = $value;
    }
    
    /*---------------*/
    public function getIdNominacion()
    {
            return $this->idNominacion;
    }
    public function getIdCategoria()
    {
            return $this->idCategoria;
    }
    public function getIdPelicula()
    {
            return $this->idPelicula;
    }
    public function getIdProfesional()
    {
            return $this->idProfesional;
    }
    public function getIdEdicionEvento()
    {
            return $this->idEdicionEvento;
    }
    public function getPelicula()
    {
            return $this->pelicula;
    }
    public function getProfesional()
    {
            return $this->profesional;
    }
    public function getCategoria()
    {
            return $this->categoria;
    }
    /*----------------*/

    /*--------------------------*/
    /* Constructores		 	*/
    /*--------------------------*/
     public function __construct()
    {
        $this->idNominacion = 0;
        
    }

    /*----------------*/

    /*--------------------------*/
    /* Métodos Grabación        */
    /*--------------------------*/

    public function graba($con){

        if (($stmt = $con->prepare("INSERT INTO nominaciones (idCategoria, idPelicula, idProfesional, idEdicionEvento) VALUES (?, ?, ?, ?)"))==true){
            $stmt->bind_param('iiii', $this->idCategoria, $this->idPelicula, $this->idProfesional, $this->idEdicionEvento);
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

    public static function dameNominaciones($con,$idNominacion=NULL,$idCategoria=NULL,$idPelicula=NULL,$idProfesional=NULL,$idEdicionEvento=NULL){
        $nominaciones = array();
        
        $sql = "SELECT * FROM nominaciones WHERE 1=1";
        
        if ($idNominacion) {
        $sql .= " AND idNominacion=".$idNominacion;
        }
        if ($idCategoria) {
            $sql .= " AND idCategoria=".$idCategoria;
        }
        if ($idPelicula) {
            $sql .= " AND idPelicula=".$idPelicula;
        }
        if ($idProfesional) {
            $sql .= " AND idProfesional=".$idProfesional;
        }
        if ($idEdicionEvento) {
            $sql .= " AND idEdicionEvento=".$idEdicionEvento;
        }
        $result = mysqli_query($con, $sql);
        
        while($row = mysqli_fetch_array($result))
        {
            $nominacion = new CNominacion();
            $nominacion->setIdNominacion($row['idNominacion']);
            $nominacion->setIdCategoria($row['idCategoria']);
            $nominacion->setIdPelicula($row['idPelicula']);
            $nominacion->setIdProfesional($row['idProfesional']);
            $nominacion->setIdEdicionEvento($row['idEdicionEvento']);
            
            if($nominacion->getIdPelicula()>0){
                $damePeliculas = negocio\CPelicula::damePeliculas($con, $nominacion->getIdPelicula(), NULL, NULL, NULL);
                $nominacion->setPelicula(array_values($damePeliculas)[0]);
            }
            
            if($nominacion->getIdProfesional()>0){
                $dameProfesionales = negocio\CProfesional::dameProfesionales($con,$nominacion->getIdProfesional(),NULL,NULL,NULL);
                $nominacion->setProfesional(array_values($dameProfesionales)[0]);
            }
            
            if($nominacion->getIdCategoria()>0){
                $dameCategorias = negocio\CCategoria::dameCategorias($con,$nominacion->getIdCategoria(),NULL,NULL);
                $nominacion->setCategoria(array_values($dameCategorias)[0]);
            }
            
            array_push($nominaciones, $nominacion);
        }
         
         return $nominaciones;

    }


    /*----------------*/
}
