<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CVotacion
 *
 * @author descoriza
 */
class CVotacion {
    /*--------------------------*/
    /* Propiedades Privadas 	*/
    /*--------------------------*/
    private $idVotacion;
    private $idUsuario;
    private $idPelicula;
    private $votacion;
    private $nEdicionOscar;
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
    public function setIdPelicula($value)
    {
            $this->idPelicula = $value;
    }
    public function setVotacion($value)
    {
            $this->votacion = $value;
    }
    public function setNEdicionOscar($value)
    {
            $this->nEdicionOscar = $value;
    }
   
    /*---------------*/
    public function getIdVotacion()
    {
            return $this->idVotacion;
    }
    public function getIdUsuario()
    {
            return $this->idUsuario;
    }
    public function getIdPelicula()
    {
            return $this->idPelicula;
    }
    public function getVotacion()
    {
            return $this->votacion;
    }
    public function getNEdicionOscar()
    {
            return $this->nEdicionOscar;
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
    /* Métodos Grabación        */
    /*--------------------------*/

    public function graba($con){

        if (($stmt = $con->prepare("INSERT INTO votacion (idVotacion, idUsuario, idPelicula, votacion,"
                . " nEdicionOscar) VALUES (?, ?, ?, ?, ?)"))==true){
            $stmt->bind_param('iiiii', $this->idVotacion, $this->idUsuario, $this->idPelicula, $this->votacion, $this->nEdicionOscar);
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

    public static function damePelicula($con,$idPelicula=NULL,$codigo=NULL,$idCategoria=NULL,$nEdicionOscar=NULL){
        $peliculas = array();
        
        $sql = "SELECT * FROM peliculas WHERE 1=1";
        
        if ($idPelicula) {
        $sql .= " AND idPelicula=".$idPelicula;
        }
        if ($codigo) {
            $sql .= " AND codigo='".$codigo."'";
        }
        if ($idCategoria) {
            $sql .= " AND idCategoria=".$idCategoria;
        }
        if ($nEdicionOscar) {
            $sql .= " AND nEdicionOscar=".$nEdicionOscar;
        }
       
        $result = mysqli_query($con, $sql);
        
        while($row = mysqli_fetch_array($result))
        {
            $pelicula = new CPelicula();
            $pelicula->setIdPelicula($row['idPelicula']);
            $pelicula->setIdCategoria($row['idCategoria']);
            $pelicula->setCodigo($row['codigo']);
            $pelicula->setNEdicionOscar($row['nEdicionOscar']);
            array_push($peliculas, $pelicula);
        }
         
         return $peliculas;

    }

}
