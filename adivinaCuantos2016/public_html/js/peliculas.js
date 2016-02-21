$(document).ready(function(){
   inicializaPeliculas();
});

function inicializaPeliculas(){
     $("#enlacePrev").addClass("hidden");
    $("#imgCargando").removeClass("hidden");
    //$('#titulo-seccion-nominados').text('Mejor Película (Best picture)');
    $.ajax({
		type: "POST",
		url: "damePeliculas.php",
		data: { "idSeccion" :  1 },
		success: function(data){
			$("#textoFichas").html(data);
                        //$('#titulo-seccion-nominados').text('Mejor Película (Best picture)');
                        $('#lblSeccion').text(1);
                        $("#imgCargando").addClass("hidden");
		}
	});
    
    
}


function cargaPeliculas(siguienteSeccion){
    var idSeccion =parseInt($('#lblSeccion').text());
    switch(siguienteSeccion) {
        case 0:
            idSeccion-=1;
            break;
        case 1:
            idSeccion+=1;
            break;
    }
    $("#imgCargando").removeClass("hidden");
    $("#textoFichas").html('');
    $.ajax({
		type: "POST",
		url: "damePeliculas.php",
		data: { "idSeccion" :  idSeccion },
		success: function(data){
                        $("#imgCargando").addClass("hidden");
			$("#textoFichas").html(data);
                        $('#lblSeccion').text(idSeccion);
                        
                        //$("#enlacePrev").removeClass("hidden");
                        //$("#enlaceNext").removeClass("hidden");

     /*               switch(idSeccion) {
                            case 1:
                                $('#titulo-seccion-nominados').text('Mejor Película (Best picture)');
                                $("#enlacePrev").addClass("hidden");
                                break;
                            case 2:
                                $('#titulo-seccion-nominados').text('Mejor Director (Directing)');
                                break;
                            case 3:
                                $('#titulo-seccion-nominados').text('Mejor Actor Principal (Actor, in a leading role)');
                                break;
                            case 4:
                                $('#titulo-seccion-nominados').text('Mejor Actriz Principal (Actress, in a leading role)');
                                break;
                            case 5:
                                $('#titulo-seccion-nominados').text('Mejor Actor de reparto (Actor, in a supporting role)');
                                break;
                            case 6:
                                $('#titulo-seccion-nominados').text('Mejor Actriz de reparto (Actress, in a supporting role)');
                                break;
                            case 7:
                                $('#titulo-seccion-nominados').text('Mejor Película Animada (Animated feature film)');
                                break;
                            case 8:
                                $('#titulo-seccion-nominados').text('Mejor Cortometraje Animado (Animated short film)');
                                break;
                            case 9:
                                $('#titulo-seccion-nominados').text('Mejor Película de Habla Extranjera (Foreign language)');
                                break;
                            case 10:
                                $('#titulo-seccion-nominados').text('Mejor Cortometraje (Live action short film)');
                                break;
                            case 11:
                                $('#titulo-seccion-nominados').text('Mejor Largometraje Documental (Documentary feature)');
                                break;
                            case 12:
                                $('#titulo-seccion-nominados').text('Mejor Cortometraje Documental (Documentary short)');
                                break;
                            case 13:
                                $('#titulo-seccion-nominados').text('Mejor Fotografía (Cinematography)');
                                break;
                            case 14:
                                $('#titulo-seccion-nominados').text('Mejor Montaje (Film editing)');
                                break;
                            case 15:
                                $('#titulo-seccion-nominados').text('Mejores Efectos Visuales (Visual effects)');
                                break;
                            case 16:
                                $('#titulo-seccion-nominados').text('Mejor Guión Original (Writing Original Screenplay)');
                                break;
                            case 17:
                                $('#titulo-seccion-nominados').text('Mejor Guión Adaptado (Writing Adapted Screenplay)');
                                break;
                            case 18:
                                $('#titulo-seccion-nominados').text('Mejor Sonido (Sound Mixing)');
                                break;
                            case 19:
                                $('#titulo-seccion-nominados').text('Mejor Montaje Sonido (Sound editing)');
                                break;
                            case 20:
                                $('#titulo-seccion-nominados').text('Mejor Banda Sonora (Music written for motion picture)');
                                break;
                            case 21:
                                $('#titulo-seccion-nominados').text('Mejor Canción (Music written for motion pictures)');
                                break;
                            case 22:
                                $('#titulo-seccion-nominados').text('Mejor Dirección Artística (Production design)');
                                break;
                            case 23:
                                $('#titulo-seccion-nominados').text('Mejor Vestuario (Costume design)');
                                break;
                            case 24:
                                $('#titulo-seccion-nominados').text('Mejor Maquillaje (Make up and hairstyling)');
                                break;
                            default:
                                $('#titulo-seccion-nominados').text('MEJOR PELÍCULA');
                                $("#enlaceNext").addClass("hidden");
                                break;
                        }*/
               }
	});
}


function vota(){
    var contador = 0;
    var nNominacion10 = "";
    var nNominacion5 = "";
    $("#textoFichas input").each(function () 
        { 
            var myId = $(this).attr("id");
            if( $(this).prop('checked') ) {
                contador++;
                var atributoName = document.getElementById(myId).getAttribute("name");
                if(atributoName=='10'){
                    nNominacion10 = myId.replace("vota10-","");
                }else{
                    nNominacion5 = myId.replace("vota5-","");
                }
               
            }
        }); 
        
        if(contador == 2){
            if(nNominacion10 == nNominacion5){
                alert("No puedes votar al mismo candidato con 10 y con 5 ptos.");        
            }else{
                alert("ha votado al ID= " + nNominacion10 + "con 10 ptos y al ID="+ nNominacion5 + " con 5 ptos");
                cargaPeliculas(1);
            }
        }else{
            alert("Tienes que votar con 10 y 5 puntos.");
        }
        
}

function validarUsuario(){
 
  $.ajax({
		type: "POST",
		url: "validaUsuario.php",
		data: { "emailUsuario" :  $("#inputEmail").val() , "nickUsuario" : $("#inputNick").val() },
		success: function(data){
                       if(data!=="0"){
                            inicializaPeliculas();
                             $("#inputEmail").val("");
                             $("#inputNick").val("");
                            $('#usuarios').modal('hide');
                        }else{
                            alert("Usuario No Encontrado");
                        }
                               
               }
	});
}
