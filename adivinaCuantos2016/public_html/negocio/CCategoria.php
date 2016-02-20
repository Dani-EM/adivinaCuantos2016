<?php namespace negocio;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CCategoria
 *
 * @author descoriza
 */
class CCategoria {
    /*--------------------------*/
    /* Propiedades Privadas 	*/
    /*--------------------------*/
    private $idCategoria;
    private $descripcion;
    private $tipoCategoria;
    /*----------------*/

    /*--------------------------*/
    /* Propiedades Públicas 	*/
    /*--------------------------*/
    public function setIdCategoria($value)
    {
            $this->idCategoria = $value;
    }
    public function setDescripcion($value)
    {
            $this->descripcion = $value;
    }
    public function setTipoCategoria($value)
    {
            $this->tipoCategoria = $value;
    }
   
    /*---------------*/
    public function getIdCategoria()
    {
            return $this->idCategoria;
    }
    public function getDescripcion()
    {
            return $this->descripcion;
    }
    public function getTipoCategoria()
    {
            return $this->tipoCategoria;
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
    /* Métodos Grabación        */
    /*--------------------------*/

    public function graba($con){

        if (($stmt = $con->prepare("INSERT INTO categorias (descripcion, tipoCategoria) VALUES (?, ?)"))==true){
            $stmt->bind_param('si', $this->descripcion, $this->tipoCategoria);
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

    public static function dameCategorias($con,$idCategoria=NULL,$descripcion=NULL,$tipoCategoria=NULL){
        $categorias = array();
        
        $sql = "SELECT * FROM categorias WHERE 1=1";
        
        if ($idCategoria) {
        $sql .= " AND idCategoria=".$idCategoria;
        }
        if ($descripcion) {
            $sql .= " AND descripcion='".$descripcion."'";
        }
        if ($tipoCategoria) {
            $sql .= " AND tipoCategoria=".$tipoCategoria;
        }
       
        $result = mysqli_query($con, $sql);
        
        while($row = mysqli_fetch_array($result))
        {
            $categoria = new CCategoria();
            $categoria->setIdCategoria($row['idCategoria']);
            $categoria->setDescripcion($row['descripcion']);
            $categoria->setTipoCategoria($row['tipoCategoria']);
            array_push($categorias, $categoria);
        }
         
         return $categorias;

    }


    /*----------------*/
}
