<?php

include("negocio/CUsuario.php");

$host="mysql.hostinger.es";  //mysql.hostinger.es localhost
    $user="u755245033_admin";  //u755245033_admin root
    $password="admin1234"; //admin1234
    $db="u755245033_cine"; //u755245033_cine concurso_cine
    $con=mysqli_connect($host,$user,$password,$db);

    // Check connection
    if (mysqli_connect_errno())
    {
        echo "ERROR EN LA BBDD " . mysqli_connect_error();
    }else
    {
        session_start();
        $nickUsuario = $_POST["nickUsuario"];
        $emailUsuario = $_POST["emailUsuario"]; 
        $usuario = CUsuario::dameUsuario($con,$nickUsuario,$emailUsuario);
        
        $_SESSION["usuario"]=$usuario->getIdUsuario();
        
        echo $usuario->getIdUsuario();
        mysqli_close($con);
    }



