<?php namespace negocio;

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
    private $idTmdb; //Id de la API
    private $tituloPelicula;
    private $IMDB_ID;
    private $urlImg;
    /*----------------*/

    /*--------------------------*/
    /* Propiedades Públicas 	*/
    /*--------------------------*/
    public function setIdPelicula($value)
    {
            $this->idPelicula = $value;
    }
    public function setIdTmdb($value)
    {
            $this->idTmdb = $value;
    }
    public function setTituloPelicula($value)
    {
            $this->tituloPelicula = $value;
    }
    public function setIMDB_ID($value)
    {
            $this->IMDB_ID = $value;
    }
    public function setUrlImg($value)
    {
            $this->urlImg = $value;
    }
   
    /*---------------*/
    public function getIdPelicula()
    {
            return $this->idPelicula;
    }
    public function getIdTmdb()
    {
            return $this->idTmdb;
    }
    public function getTituloPelicula()
    {
            return $this->tituloPelicula;
    }
    public function getIMDB_ID()
    {
            return $this->IMDB_ID;
    }
    public function getUrlImg()
    {
            return $this->urlImg;
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

        if (($stmt = $con->prepare("INSERT INTO peliculas (idTmdb, tituloPelicula, IMDB_ID, urlImg) VALUES (?, ?, ?, ?)"))==true){
            $stmt->bind_param('ssss', $this->idTmdb, $this->tituloPelicula, $this->IMDB_ID, $this->urlImg);
            $stmt->execute();

            return $stmt->affected_rows;
             
         }
         /*else{
             die ("Mysql Error: " . $con->error);
             
         }*/
       
        
    }

    /*--------------------------*/
    /* Métodos Recuperación     */
    /*--------------------------*/

    public static function damePeliculas($con,$idPelicula=NULL,$idTmdb=NULL,$tituloPelicula=NULL,$IMDB_ID=NULL){
        $peliculas = array();
        
        $sql = "SELECT * FROM peliculas WHERE 1=1";
        
        if ($idPelicula) {
        $sql .= " AND idPelicula=".$idPelicula;
        }
        if ($idTmdb) {
            $sql .= " AND idTmdb='".$idTmdb."'";
        }
        if ($tituloPelicula) {
            $sql .= " AND tituloPelicula='".$tituloPelicula."'";
        }
        if ($IMDB_ID) {
            $sql .= " AND IMDB_ID='".$IMDB_ID."'";
        }
       
        $result = mysqli_query($con, $sql);
        
        while($row = mysqli_fetch_array($result))
        {
            $pelicula = new CPelicula();
            $pelicula->setIdPelicula($row['idPelicula']);
            $pelicula->setIdTmdb($row['idTmdb']);
            $pelicula->setTituloPelicula($row['tituloPelicula']);
            $pelicula->setIMDB_ID($row['IMDB_ID']);
            $pelicula->setUrlImg($row['urlImg']);
            array_push($peliculas, $pelicula);
        }
         
         return $peliculas;

    }


    /*----------------*/
}
