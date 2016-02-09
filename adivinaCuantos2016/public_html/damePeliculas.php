<?php
    include("tmdb-api.php");

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
    
    
    $apikey = "4972b5e1982e20a5f94ee1beed565e82";
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

        if($id != ''){
           $movie = $tmdb->getMovie($id);
           /*
            echo 'Now the <b>$movie</b> var got all the data, check the <a href="http://code.octal.es/php/tmdb-api/class-Movie.html">documentation</a> for the complete list of methods.<br><br>';

            echo '<b>'. $movie->getTitle() .'</b><ul>';
            echo '  <li>ID:'. $movie->getID() .'</li>';
            echo '  <li>Tagline:'. $movie->getTagline() .'</li>';
            echo '  <li>Trailer: <a href="https://www.youtube.com/watch?v='. $movie->getTrailer() .'">link</a></li>';
            echo '</ul>...';
            echo '<img src="'. $tmdb->getImageURL('w185') . $movie->getPoster() .'"/></li>';*/
           
           $retorno.='<div class="col-xs-12 col-sm-4 div-pelicula">';
           $retorno.='<div class="portfolio_single_content">';
           $retorno.='<img src="'. $tmdb->getImageURL('w500') . $movie->getPoster() .'"/>';
         /*  $retorno.='<p class="nombre">';
           $retorno.=$movie->getTitle();
           $retorno.='</p>';*/
           $retorno.='<div class="text-center">';
           $retorno.='<p class="tituloPelicula">'.$movie->getTitle().'</p>';
           //$retorno.='<a href="https://www.youtube.com/watch?v='. $movie->getTrailer() .'" target="_blank"><i class="fa fa-2x fa-youtube-play"></i></a>';
           //$retorno.='<span>Pete Docter y Ronnie Del Carmen</span>';
           $retorno.='</div>';
           $retorno.='</div>';
           $retorno.='</div>';
        }

    }
    fclose($file);

    echo $retorno;
 ?>
