<?php namespace negocio;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CProfesional
 *
 * @author descoriza
 */
class CProfesional {
    /*--------------------------*/
    /* Propiedades Privadas 	*/
    /*--------------------------*/
    private $idProfesional;
    private $idTmdb;
    private $nombre;
    private $IMDB_ID;
    private $urlImg;
    /*----------------*/

    /*--------------------------*/
    /* Propiedades Públicas 	*/
    /*--------------------------*/
    public function setIdProfesional($value)
    {
            $this->idProfesional = $value;
    }
    public function setIdTmdb($value)
    {
            $this->idTmdb = $value;
    }
    public function setNombre($value)
    {
            $this->nombre = $value;
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
    public function getIdProfesional()
    {
            return $this->idProfesional;
    }
    public function getIdTmdb()
    {
            return $this->idTmdb;
    }
    public function getNombre()
    {
            return $this->nombre;
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
        $this->idProfesional = 0;
    }

    /*----------------*/

    /*--------------------------*/
    /* Métodos Grabación        */
    /*--------------------------*/

    public function graba($con){

        if (($stmt = $con->prepare("INSERT INTO profesionales (idTmdb, nombre, IMDB_ID, urlImg) VALUES (?, ?, ?, ?)"))==true){
            $stmt->bind_param('ss', $this->idTmdb, $this->nombre, $this->IMDB_ID, $this->urlImg);
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

    public static function dameProfesionales($con,$idProfesional=NULL,$idTmdb=NULL,$nombre=NULL,$IMDB_ID=NULL){
        $profesionales = array();
        
        $sql = "SELECT * FROM profesionales WHERE 1=1";
        
        if ($idProfesional) {
        $sql .= " AND idProfesional=".$idProfesional;
        }
        if ($idTmdb) {
            $sql .= " AND idTmdb='".$idTmdb."'";
        }
        if ($nombre) {
            $sql .= " AND nombre='".$nombre."'";
        }
        if ($IMDB_ID) {
            $sql .= " AND IMDB_ID='".$IMDB_ID."'";
        }
        
        $result = mysqli_query($con, $sql);
        
        while($row = mysqli_fetch_array($result))
        {
            $profesional = new CProfesional();
            $profesional->setIdProfesional($row['idProfesional']);
            $profesional->setIdTmdb($row['idTmdb']);
            $profesional->setNombre($row['nombre']);
            $profesional->setIMDB_ID($row['IMDB_ID']);
            $profesional->setUrlImg($row['urlImg']);
            array_push($profesionales, $profesional);
        }
         
         return $profesionales;

    }


    /*----------------*/
}
