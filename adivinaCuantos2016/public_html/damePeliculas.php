<?php
 //   include("tmdb-api.php");

    /*
<div class="col-xs-12 col-sm-4 mejor-pelicula-animada">
                                                <div class="portfolio_single_content">
                                                    <img src="img/portfolio/p1.jpg" alt="title"/>
                                                  <p class="nombre">
                                                            <asp:Label ID="lblNombreCompleto" runat="server" Text=""></asp:Label>            
                                                    </p>
                                                    <div>
                                                        <a href="#">Del revés</a>
                                                        <span>Pete Docter y Ronnie Del Carmen</span>
                                                    </div>
                                                </div>
                                            </div>
     * 
     *      */
    
    
/*    $apikey = "4972b5e1982e20a5f94ee1beed565e82";
    $tmdb = new TMDB($apikey, 'es', false);

    $retorno = '';
    $idSeccion = $_POST["idSeccion"];
    $nombreArchivo = '';
    
    switch ($idSeccion) {
        case 1:
            $nombreArchivo = 'peliculas/mejor-pelicula.txt';
            break;
        case 2:
            $nombreArchivo = 'peliculas/mejor-director.txt';
            break;
        case 3:
            $nombreArchivo = 'peliculas/mejor-actor.txt';
            break;
        case 4:
            $nombreArchivo = 'peliculas/mejor-actriz.txt';
            break;
        case 5:
            $nombreArchivo = 'peliculas/mejor-actor-reparto.txt';
            break;
        case 6:
            $nombreArchivo = 'peliculas/mejor-actriz-reparto.txt';
            break;
        case 7:
            $nombreArchivo = 'peliculas/mejor-pelicula-animada.txt';
            break;
        case 8:
            $nombreArchivo = 'peliculas/mejor-guion-original.txt';
            break;
        case 9:
            $nombreArchivo = 'peliculas/mejor-guion-adaptado.txt';
            break;
        case 10:
            $nombreArchivo = 'peliculas/mejor-pelicula-habla-no-inglesa.txt';
            break;
        case 11:
            $nombreArchivo = 'peliculas/mejor-disenyo-produccion.txt';
            break;
        case 12:
            $nombreArchivo = 'peliculas/mejor-fotografia.txt';
            break;
        case 13:
            $nombreArchivo = 'peliculas/mejor-vestuario.txt';
            break;
        case 14:
            $nombreArchivo = 'peliculas/mejor-montaje.txt';
            break;
        case 15:
            $nombreArchivo = 'peliculas/mejor-efectos-visuales.txt';
            break;
        case 16:
            $nombreArchivo = 'peliculas/mejor-maquillaje-peluqueria.txt';
            break;
        case 17:
            $nombreArchivo = 'peliculas/mejor-edicion-sonido.txt';
            break;
        case 18:
            $nombreArchivo = 'peliculas/mejor-mezcla-sonido.txt';
            break;
        case 19:
            $nombreArchivo = 'peliculas/mejor-banda-sonora.txt';
            break;
        case 20:
            $nombreArchivo = 'peliculas/mejor-cancion.txt';
            break;
        case 21:
            $nombreArchivo = 'peliculas/mejor-documental.txt';
            break;
        case 22:
            $nombreArchivo = 'peliculas/mejor-cortometraje.txt';
            break;
        case 23:
            $nombreArchivo = 'peliculas/mejor-corto-documental.txt';
            break;
        case 24:
            $nombreArchivo = 'peliculas/mejor-cortometraje-animado.txt';
            break;
        default:
            $nombreArchivo = 'peliculas/mejor-pelicula.txt';
    }
    
    $file = fopen($nombreArchivo, "r") or exit("Unable to open file!");
    //Output a line of the file until the end is reached
    while(!feof($file))
    {
        $id =  fgets($file);
        $id = preg_replace("[\n|\r|\n\r]", '', $id );
        $id = trim($id);

        if($id != ''){
            if($id != '-'){
                $movie = $tmdb->getMovie($id);
                /*
                 echo 'Now the <b>$movie</b> var got all the data, check the <a href="http://code.octal.es/php/tmdb-api/class-Movie.html">documentation</a> for the complete list of methods.<br><br>';

                 echo '<b>'. $movie->getTitle() .'</b><ul>';
                 echo '  <li>ID:'. $movie->getID() .'</li>';
                 echo '  <li>Tagline:'. $movie->getTagline() .'</li>';
                 echo '  <li>Trailer: <a href="https://www.youtube.com/watch?v='. $movie->getTrailer() .'">link</a></li>';
                 echo '</ul>...';
                 echo '<img src="'. $tmdb->getImageURL('w185') . $movie->getPoster() .'"/></li>';*/

   /*             $retorno.='<div class="col-xs-12 col-sm-4 div-pelicula">';
                $retorno.='<div class="portfolio_single_content">';
                $retorno.='<img src="'. $tmdb->getImageURL('w500') . $movie->getPoster() .'"/>';
              /*  $retorno.='<p class="nombre">';
                $retorno.=$movie->getTitle();
                $retorno.='</p>';*/
  /*              $retorno.='<div class="text-center">';
                $retorno.='<p class="tituloPelicula">'.$movie->getTitle().'</p>';
                //$retorno.='<a href="https://www.youtube.com/watch?v='. $movie->getTrailer() .'" target="_blank"><i class="fa fa-2x fa-youtube-play"></i></a>';
                //$retorno.='<span>Pete Docter y Ronnie Del Carmen</span>';
                $retorno.='</div>';
                $retorno.='</div>';
                $retorno.='</div>';
            }else{
                $id =  fgets($file);
                $retorno.='<div class="col-xs-12 col-sm-4 div-pelicula">';
                $retorno.='<div class="portfolio_single_content no_image">';
                $retorno.='<img src="img/no-image.jpg"/>';
              /*  $retorno.='<p class="nombre">';
                $retorno.=$movie->getTitle();
                $retorno.='</p>';*/
                $retorno.='<div class="text-center">';
                $retorno.='<p class="tituloPelicula">'.$id.'</p>';
                //$retorno.='<a href="https://www.youtube.com/watch?v='. $movie->getTrailer() .'" target="_blank"><i class="fa fa-2x fa-youtube-play"></i></a>';
                //$retorno.='<span>Pete Docter y Ronnie Del Carmen</span>';
                $retorno.='</div>';
                $retorno.='</div>';
                $retorno.='</div>';
 /*           }
        }

    }
    fclose($file);

    echo $retorno;
 ?>


*/



$idCategoria = $_POST["idSeccion"];
$retorno = '';

include("negocio/CNominacion.php");
        
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
    //dameNominaciones($con,$idNominacion=NULL,$idCategoria=NULL,$idPelicula=NULL,$idProfesional=NULL,$idEdicionEvento=NULL){
    $nominaciones = CNominacion::dameNominaciones($con, NULL, $idCategoria, NULL, NULL, NULL);
    
    mysqli_close($con);

    /*
    <li class="list-group-item">
        <div class="row">
                <div class="col-xs-2 col-md-1">
                        <img src="https://image.tmdb.org/t/p/w396/mVde2tB9TvR97LO7nferqTQq2nQ.jpg" class="img-circle img-responsive" alt="" /></div>
                <div class="col-xs-10 col-md-11">
                        <div>
                                <a href="http://www.jquery2dotnet.com/2013/10/google-style-login-page-desing-usign.html">
                                        Google Style Login Page Design Using Bootstrap</a>
                                <div class="mic-info">
                                        By: <a href="#">Bhaumik Patel</a> on 2 Aug 2013
                                </div>
                        </div>
                        <div class="comment-text">
                                Awesome design
                        </div>
                        <div class="action text-right">
                                <button type="button" class="btn btn-success btn" title="Edit">
                                        10 <span class="glyphicon glyphicon-star"></span>
                                </button>
                                <button type="button" class="btn btn-success btn" title="Approved">
                                        5 <span class="glyphicon glyphicon-star"></span>
                                </button>
                        </div>
                </div>
        </div>
    </li>

    */
    
    
   foreach($nominaciones as $nominacion){
       $retorno.='<li class="list-group-item">';
       $retorno.='<div class="row">';
       $retorno.='<div class="col-xs-2 col-md-1">';
       
       switch ($nominacion->getCategoria()->getTipoCategoria()) {
        case 0: //Peliculas
            $retorno.='<img src="'.$nominacion->getPelicula()->getUrlImg().'" class="img-circle img-responsive" alt="" /></div>';
            $retorno.='<div class="col-xs-10 col-md-11">';
            $retorno.='<div>';
            //$retorno.='<a href="http://www.jquery2dotnet.com/2013/10/google-style-login-page-desing-usign.html">';
            $retorno.='<span class="tituloPeliculaPanel">';
            $retorno.= strtoupper($nominacion->getPelicula()->getTituloPelicula());
            $retorno.='</span>';
            //$retorno.='</a>';
            //$retorno.='<div class="mic-info">';
            //$retorno.='By: <a href="#">Bhaumik Patel</a> on 2 Aug 2013';
            //$retorno.='</div>';
            $retorno.='</div>';
            $retorno.='<div class="comment-text">';
            //$retorno.='Awesome design';  
            break;
        case 1: //Profesionales
            $retorno.='<img src="'.$nominacion->getProfesional()->getUrlImg().'" class="img-circle img-responsive" alt="" /></div>';
            $retorno.='<div class="col-xs-10 col-md-11">';
            $retorno.='<div>';
            //$retorno.='<a href="http://www.jquery2dotnet.com/2013/10/google-style-login-page-desing-usign.html">';
            $retorno.='<span class="nombreProfesionalPanel">';
            $retorno.=$nominacion->getProfesional()->getNombre();
            $retorno.='</span>';
            //$retorno.='</a>';
            $retorno.='<div class="mic-info">';
            $retorno.='<span class="titPeliculaProfesionalPanel">';
            $retorno.='En: '.strtoupper($nominacion->getPelicula()->getTituloPelicula());
            $retorno.='</span>';
            $retorno.='</div>';
            $retorno.='</div>';
            $retorno.='<div class="comment-text">';
            //$retorno.='Awesome design';             
            break;
       }
       
       $retorno.='</div>';
       $retorno.='<div class="action text-right">';
       $retorno.='<button type="button" class="btn btn-success btn" title="Edit">';
       $retorno.='10 <span class="glyphicon glyphicon-star"></span>';
       $retorno.='</button>';
       $retorno.='<button type="button" class="btn btn-success btn" title="Approved">';
       $retorno.='5 <span class="glyphicon glyphicon-star"></span>';
       $retorno.='</button>';
       $retorno.='</div>';
       $retorno.='</div>';
       $retorno.='</div>';
       $retorno.='</li>';
       
       
       
       
       
       //echo $nominacion->getPelicula()->getTituloPelicula()."<br>";
 /*      echo '<b>ID => '. $nominacion->getIdNominacion() .'</b><ul>';
               echo '  <li>IDCATEGORIA: '. $nominacion->getIdCategoria() .'</li>';
               echo '  <li>IDEVENTO: '. $nominacion->getIdEdicionEvento() .'</li>';
               echo '  <li>IDPELICULA: '. $nominacion->getIdPelicula() .'</li>';
               echo '  <li>IDPROFESIONAL: '. $nominacion->getIdProfesional() .'</li>';
               echo '</ul>';
               echo '<img src="'. $nominacion->getPelicula()->getUrlImg().'"/>'; */
   }
     

}

echo $retorno;