<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CPelicula
 *
 * @author descoriza
 */
class CPelicula {
    /*--------------------------*/
    /* Propiedades Privadas 	*/
    /*--------------------------*/
    private $idPelicula;
    private $idCategoria;
    private $codigo;
    private $nEdicionOscar;
    /*----------------*/

    /*--------------------------*/
    /* Propiedades Públicas 	*/
    /*--------------------------*/
    public function setIdPelicula($value)
    {
            $this->idPelicula = $value;
    }
    public function setIdCategoria($value)
    {
            $this->idCategoria = $value;
    }
    public function setCodigo($value)
    {
            $this->codigo = $value;
    }
    public function setNEdicionOscar($value)
    {
            $this->nEdicionOscar = $value;
    }
   
    /*---------------*/
    public function getIdPelicula()
    {
            return $this->idPelicula;
    }
    public function getIdCategoria()
    {
            return $this->idCategoria;
    }
    public function getCodigo()
    {
            return $this->codigo;
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
        $this->idPelicula = 0;
    }

    /*----------------*/

    /*--------------------------*/
    /* Métodos Grabación        */
    /*--------------------------*/

    public function graba($con){

        if (($stmt = $con->prepare("INSERT INTO peliculas (idCategoria, codigo, nEdicionOscar) VALUES (?, ?, ?)"))==true){
            $stmt->bind_param('isi', $this->idCategoria, $this->codigo, $this->nEdicionOscar);
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


    /*----------------*/
}
