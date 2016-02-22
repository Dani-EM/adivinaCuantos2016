<?php

if(isset($_POST['validaUsuario'])) {
  echo validaUsuario();
} 

if(isset($_POST['dameNominaciones'])) {
  echo dameNominaciones();
} 

if(isset($_POST['agregaVotacion'])) {
  echo agregaVotacion();
} 

function validaUsuario(){
    include("../negocio/CUsuario.php");

    $host="mysql.hostinger.es";  //mysql.hostinger.es localhost
    $user="u755245033_admin";  //u755245033_admin root
    $password="admin1234"; //admin1234
    $db="u755245033_cine"; //u755245033_cine concurso_cine
    $con=mysqli_connect($host,$user,$password,$db);

    // Check connection
    if (mysqli_connect_errno())
    {
        return "ERROR EN LA BBDD " . mysqli_connect_error();
    }else
    {
        $nickUsuario = '';
        $emailUsuario = '';
        
        if(isset($_POST['nickUsuario'])) {
            $nickUsuario = $_POST["nickUsuario"];
        }
        if(isset($_POST['emailUsuario'])) {
            $emailUsuario = $_POST["emailUsuario"]; 
        } 
        session_start();
        
        $usuario = CUsuario::dameUsuario($con,$nickUsuario,$emailUsuario);
        
        if ($usuario->getIdUsuario() > 0) {
            $_SESSION["usuario"]=$usuario->getIdUsuario();
        }
        
        mysqli_close($con);
        
        return $usuario->getIdUsuario();
    }   
    
}

function dameNominaciones_old(){
    $retorno = '';

    session_start();
    if($_SESSION["usuario"]==""){
        $retorno = '<div class="container">
                    <div class="row">
                    <div class="col-xs-1"></div>
                    <div class="col-xs-1">
                    </div>
                    <div class="col-xs-8 text-center">
                    <h3>Logueate desde el login del menú superior</h3>
                    </div>
                    <div class="col-xs-1">
                    </div>
                    <div class="col-xs-1"></div>
                    </div>
                    </div>';
    }else{
        $idCategoria = '0';
        if(isset($_POST['idSeccion'])) {
            $idCategoria = $_POST["idSeccion"];
        } 
        
        if($idCategoria==25){
            $retorno = '<div class="container">
                        <div class="row">
                        <div class="col-xs-1"></div>
                        <div class="col-xs-1">
                        </div>
                        <div class="col-xs-8 text-center">
                        <h3>¡¡ENHORABUENA!! Ya tenemos tus votaciones.</h3>
                        <h3>¡¡¡¡MUCHA SUERTE!!!!</h3>
                        </div>
                        <div class="col-xs-1">
                        </div>
                        <div class="col-xs-1"></div>
                        </div>
                        </div>';

        }else{

            include("../negocio/CNominacion.php");

            $host="mysql.hostinger.es";  //mysql.hostinger.es localhost
            $user="u755245033_admin";  //u755245033_admin root
            $password="admin1234"; //admin1234
            $db="u755245033_cine"; //u755245033_cine concurso_cine
            $con=mysqli_connect($host,$user,$password,$db);

            // Check connection
            if (mysqli_connect_errno())
            {
                return "ERROR EN LA BBDD " . mysqli_connect_error();
            }else
            {
                //dameNominaciones($con,$idNominacion=NULL,$idCategoria=NULL,$idPelicula=NULL,$idProfesional=NULL,$idEdicionEvento=NULL){
                $nominaciones = CNominacion::dameNominaciones($con, NULL, $idCategoria, NULL, NULL, NULL);

                mysqli_close($con);
                $retorno.='<div class="container">
                            <div class="row">
                            <div class="col-xs-2"></div>
                            <div class="col-xs-8 text-center">
                            <h3><label id="titulo-seccion-nominados">'.$nominaciones[0]->getCategoria()->getDescripcion().'</label></h3>
                            </div>
                            <div class="col-xs-2">
                            <a onclick="vota()" id="enlaceNext" class="btn btn-primary btn-blank">Votar</a>
                            </div>
                            </div>
                            </div><div class="container">';
                foreach($nominaciones as $nominacion){
                   $retorno.='<div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="offer offer-default negocio">
                    <div class="row">
                    <div class="col-xs-8 col-md-8 text-right">
                    <div>
                    <div class="extra-space-m"></div>';

                   switch ($nominacion->getCategoria()->getTipoCategoria()) {
                    case 0: //Peliculas
                        $retorno.='<h5>'.$nominacion->getPelicula()->getTituloPelicula().'</h5>';
                        break;
                    case 1: //Profesionales
                        $retorno.='<h5>'.$nominacion->getProfesional()->getNombre().'</h5>';
                        $retorno.='<p><strong>por:</strong>'.$nominacion->getPelicula()->getTituloPelicula().'</p>';
                        break;
                   }
                   $retorno.='<div class="devider"></div>';  
                   $retorno.='<p style="margin-top: 4px;">
                                <button type="button" class="btn btn-success">
                                <input type="radio" id="vota10-'.$nominacion->getIdNominacion().'" name="10">
                                <label for="vota10-'.$nominacion->getIdNominacion().'">
                                <span style="color:white;">10&nbsp;</span> 
                                <span class="fa fa-star"></span></label>
                                </button>
                                <button type="button" class="btn btn-success">
                                <input type="radio" id="vota5-'.$nominacion->getIdNominacion().'" name="5">
                                <label for="vota5-'.$nominacion->getIdNominacion().'">
                                <span style="color:white;">5&nbsp;</span> 
                                <span class="fa fa-star"></span></label>
                                </button>
                                </p>
                                <div class="extra-space-m"></div>
                                </div>
                                </div>
                                <div class="col-xs-4 col-md-4">';

                   switch ($nominacion->getCategoria()->getTipoCategoria()) {
                    case 0: //Peliculas
                        $retorno.='<img src="'.$nominacion->getPelicula()->getUrlImg().'" class="img img-responsive" /></div>';
                        break;

                    case 1: //Profesionales
                        $retorno.='<img src="'.$nominacion->getProfesional()->getUrlImg().'" class="img img-responsive" /></div>';
                        break;
                   }

                   $retorno.='</div></div></div>';

                }
            }
            $porcentaje = 4 * $idCategoria;
            $retorno.='</div><div class="container">
                        <div class="extra-space-m"></div>';

            if($idCategoria<25){
            $retorno.='<div class="row bs-wizard" style="border-bottom:0;">
                        <div class="col-xs-3 bs-wizard-step complete">
                        <div class="text-center bs-wizard-stepnum"><h6>Las Divertidas!!</h6></div>
                        </div>
                        <div class="col-xs-3 bs-wizard-step complete">
                        <div class="text-center bs-wizard-stepnum"><h6>Menos Populares</h6></div>
                        </div>
                        <div class="col-xs-3 bs-wizard-step active">
                        <div class="text-center bs-wizard-stepnum"><h6>!!!Puro Cinema!!!</h6></div>
                        </div>        
                        <div class="col-xs-3 bs-wizard-step">
                        <div class="text-center bs-wizard-stepnum"><h6>!Y Esto Fue Todo!</h6></div>
                        </div>        
                        </div>';
            }
            $retorno.='<div class="row bs-wizard" style="border-bottom:0;">
                        <div class="col-xs-12 bs-wizard-step complete">
                        <div class="progress" style="left:0; width:100%;"><div class="progress-bar"></div></div>
                        <div class="bs-wizard-dot" style="left:'.$porcentaje.'%"><img src="img/logo_solo.png" class="img-responsive"/></div>
                        </div>
                        </div>
                        </div>';  


        }
    }
    return $retorno;
}

function agregaVotacion(){
    $idUsuario = 0;
    $idNominacion10 = 0;
    $idNominacion5 = 0;
    $idCategoria = 0;
    
    session_start();
    if($_SESSION["usuario"]==""){
        return 'Usuario no encontrado.';
    }else{
        $idUsuario = $_SESSION["usuario"];
    }
    
    if(isset($_POST['idNominacion10'])) {
        $idNominacion10 = $_POST['idNominacion10'];
    }
    if(isset($_POST['idNominacion5'])) {
        $idNominacion5 = $_POST['idNominacion5'];
    }
    if(isset($_POST['idCategoria'])) {
        $idCategoria = $_POST['idCategoria'];
    }
    
    if(($idUsuario > 0) && ($idNominacion10 > 0) && ($idNominacion5 > 0)){
        include("../negocio/CVotacion.php");

        $host="mysql.hostinger.es";  //mysql.hostinger.es localhost
        $user="u755245033_admin";  //u755245033_admin root
        $password="admin1234"; //admin1234
        $db="u755245033_cine"; //u755245033_cine concurso_cine
        $con=mysqli_connect($host,$user,$password,$db);

        // Check connection
        if (mysqli_connect_errno())
        {
            return "ERROR EN LA BBDD " . mysqli_connect_error();
        }else
        {
            $idCategoria = CVotacion::dameUltimaCategoriaVotada($con, $_SESSION["usuario"]);
            $idCategoria = $idCategoria + 1;
            //($con,$idVotacion=NULL,$idUsuario=NULL,$idNominacion=NULL,$idCategoria=NULL,$puntuacion=NULL){
            $votaciones10 = CVotacion::dameVotaciones($con, NULL, $idUsuario, NULL, $idCategoria, 10);
            $votacion10 = new CVotacion();
            if(count($votaciones10)>0){
                $votacion10 = $votaciones10[0];
            }
            
            $votacion10->setIdUsuario($idUsuario);
            $votacion10->setIdCategoria($idCategoria);
            $votacion10->setIdNominacion($idNominacion10);
            $votacion10->setPuntuacion(10);
            
            $votacion10->graba($con);
            
            //($con,$idVotacion=NULL,$idUsuario=NULL,$idNominacion=NULL,$idCategoria=NULL,$puntuacion=NULL){
            $votaciones5 = CVotacion::dameVotaciones($con, NULL, $idUsuario, NULL, $idCategoria, 5);
            $votacion5 = new CVotacion();
            if(count($votaciones5)>0){
                $votacion5 = $votaciones5[0];
            }
            $votacion5->setIdUsuario($idUsuario);
            $votacion5->setIdCategoria($idCategoria);
            $votacion5->setIdNominacion($idNominacion5);
            $votacion5->setPuntuacion(5);
            
            $votacion5->graba($con);
            
            mysqli_close($con);
            return 'Correctamente votado has tu';
        }
          
    }else{
        return 'ERROR';
    }
    
    
}

function dameNominaciones(){
    $retorno = '';

    session_start();
    if($_SESSION["usuario"]==""){
        $retorno = '<div class="container">
                    <div class="row">
                    <div class="col-xs-1"></div>
                    <div class="col-xs-1">
                    </div>
                    <div class="col-xs-8 text-center">
                    <h3>Logueate desde el login del menú superior</h3>
                    </div>
                    <div class="col-xs-1">
                    </div>
                    <div class="col-xs-1"></div>
                    </div>
                    </div>';
    }else{
        include("../negocio/CNominacion.php");
        include("../negocio/CVotacion.php");

        $host="mysql.hostinger.es";  //mysql.hostinger.es localhost
        $user="u755245033_admin";  //u755245033_admin root
        $password="admin1234"; //admin1234
        $db="u755245033_cine"; //u755245033_cine concurso_cine
        $con=mysqli_connect($host,$user,$password,$db);

        // Check connection
        if (mysqli_connect_errno())
        {
            return "ERROR EN LA BBDD " . mysqli_connect_error();
        }else
        {
            $idCategoria = CVotacion::dameUltimaCategoriaVotada($con, $_SESSION["usuario"]);
            $idCategoria = $idCategoria + 1;
            //return $idCategoria;
       
            if($idCategoria==25){
                $retorno = '<div class="container">
                            <div class="row">
                            <div class="col-xs-1"></div>
                            <div class="col-xs-1">
                            </div>
                            <div class="col-xs-8 text-center">
                            <h3>¡¡ENHORABUENA!! Ya tenemos tus votaciones.</h3>
                            <h3>¡¡¡¡MUCHA SUERTE!!!!</h3>
                            </div>
                            <div class="col-xs-1">
                            </div>
                            <div class="col-xs-1"></div>
                            </div>
                            </div>';

            }else{
                    //dameNominaciones($con,$idNominacion=NULL,$idCategoria=NULL,$idPelicula=NULL,$idProfesional=NULL,$idEdicionEvento=NULL){
                    $nominaciones = CNominacion::dameNominaciones($con, NULL, $idCategoria, NULL, NULL, NULL);

                   
                    $retorno.='<div class="container">
                                <div class="row">
                                <div class="col-xs-2"></div>
                                <div class="col-xs-8 text-center">
                                <h3><label id="titulo-seccion-nominados">'.$nominaciones[0]->getCategoria()->getDescripcion().'</label></h3>
                                </div>
                                <div class="col-xs-2">
                                <a onclick="vota()" id="enlaceNext" class="btn btn-primary btn-blank">Votar</a>
                                </div>
                                </div>
                                </div><div class="container">';
                    
                    foreach($nominaciones as $nominacion){
                        $retorno.='<div class="col-xs-12 col-sm-6 col-md-4">
                         <div class="offer offer-default negocio">
                         <div class="row">
                         <div class="col-xs-8 col-md-8 text-right">
                         <div>
                         <div class="extra-space-m"></div>';

                        switch ($nominacion->getCategoria()->getTipoCategoria()) {
                         case 0: //Peliculas
                             $retorno.='<h5>'.$nominacion->getPelicula()->getTituloPelicula().'</h5>';
                             break;
                         case 1: //Profesionales
                             $retorno.='<h5>'.$nominacion->getProfesional()->getNombre().'</h5>';
                             $retorno.='<p><strong>por:</strong>'.$nominacion->getPelicula()->getTituloPelicula().'</p>';
                             break;
                        }
                        $retorno.='<div class="devider"></div>';  
                        $retorno.='<p style="margin-top: 4px;">
                                     <button type="button" class="btn btn-success">
                                     <input type="radio" id="vota10-'.$nominacion->getIdNominacion().'" name="10">
                                     <label for="vota10-'.$nominacion->getIdNominacion().'">
                                     <span style="color:white;">10&nbsp;</span> 
                                     <span class="fa fa-star"></span></label>
                                     </button>
                                     <button type="button" class="btn btn-success">
                                     <input type="radio" id="vota5-'.$nominacion->getIdNominacion().'" name="5">
                                     <label for="vota5-'.$nominacion->getIdNominacion().'">
                                     <span style="color:white;">5&nbsp;</span> 
                                     <span class="fa fa-star"></span></label>
                                     </button>
                                     </p>
                                     <div class="extra-space-m"></div>
                                     </div>
                                     </div>
                                     <div class="col-xs-4 col-md-4">';

                        switch ($nominacion->getCategoria()->getTipoCategoria()) {
                         case 0: //Peliculas
                             $retorno.='<img src="'.$nominacion->getPelicula()->getUrlImg().'" class="img img-responsive" /></div>';
                             break;

                         case 1: //Profesionales
                             $retorno.='<img src="'.$nominacion->getProfesional()->getUrlImg().'" class="img img-responsive" /></div>';
                             break;
                        }

                        $retorno.='</div></div></div>';

                    }

                $porcentaje = 4 * $idCategoria;
                $retorno.='</div><div class="container">
                            <div class="extra-space-m"></div>';

                if($idCategoria<25){
                $retorno.='<div class="row bs-wizard" style="border-bottom:0;">
                            <div class="col-xs-3 bs-wizard-step complete">
                            <div class="text-center bs-wizard-stepnum"><h6>Las Divertidas!!</h6></div>
                            </div>
                            <div class="col-xs-3 bs-wizard-step complete">
                            <div class="text-center bs-wizard-stepnum"><h6>Menos Populares</h6></div>
                            </div>
                            <div class="col-xs-3 bs-wizard-step active">
                            <div class="text-center bs-wizard-stepnum"><h6>!!!Puro Cinema!!!</h6></div>
                            </div>        
                            <div class="col-xs-3 bs-wizard-step">
                            <div class="text-center bs-wizard-stepnum"><h6>!Y Esto Fue Todo!</h6></div>
                            </div>        
                            </div>';
                }
                $retorno.='<div class="row bs-wizard" style="border-bottom:0;">
                            <div class="col-xs-12 bs-wizard-step complete">
                            <div class="progress" style="left:0; width:100%;"><div class="progress-bar"></div></div>
                            <div class="bs-wizard-dot" style="left:'.$porcentaje.'%"><img src="img/logo_solo.png" class="img-responsive"/></div>
                            </div>
                            </div>
                            </div>';  


            }
            mysqli_close($con);
        }

    }
    return $retorno;
}