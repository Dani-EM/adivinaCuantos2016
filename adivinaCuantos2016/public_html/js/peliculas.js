$(document).ready(function(){
   inicializaPeliculas();
});

function inicializaPeliculas(){
     $("#enlacePrev").addClass("hidden");
    $("#imgCargando").removeClass("hidden");
    $('#titulo-seccion-nominados').text('MEJOR PELÍCULA');
    $.ajax({
		type: "POST",
		url: "damePeliculas.php",
		data: { "idSeccion" :  1 },
		success: function(data){
			$("#portfolio").html(data);
                        $('#titulo-seccion-nominados').text('MEJOR PELÍCULA');
                        $('#lblSeccion').text(1);
                        $("#imgCargando").addClass("hidden");
		}
	});
    
    
}


function cargaPeliculas(siguienteSeccion){
    var idSeccion =parseInt($('#lblSeccion').text());
    switch(siguienteSeccion) {
        case 'next':
            idSeccion+=1;
            break;
        case 'previous':
            idSeccion-=1;
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
                        
                        $("#enlacePrev").removeClass("hidden");
                        $("#enlaceNext").removeClass("hidden");

                    switch(idSeccion) {
                            case 1:
                                $('#titulo-seccion-nominados').text('MEJOR PELÍCULA');
                                $("#enlacePrev").addClass("hidden");
                                break;
                            case 2:
                                $('#titulo-seccion-nominados').text('MEJOR DIRECTOR');
                                break;
                            case 3:
                                $('#titulo-seccion-nominados').text('MEJOR ACTOR');
                                break;
                            case 4:
                                $('#titulo-seccion-nominados').text('MEJOR ACTRIZ');
                                break;
                            case 5:
                                $('#titulo-seccion-nominados').text('MEJOR ACTOR DE REPARTO');
                                break;
                            case 6:
                                $('#titulo-seccion-nominados').text('MEJOR ACTRIZ DE REPARTO');
                                break;
                            case 7:
                                $('#titulo-seccion-nominados').text('MEJOR PELÍCULA ANIMADA');
                                break;
                            case 8:
                                $('#titulo-seccion-nominados').text('MEJOR GUIÓN ORIGINAL');
                                break;
                            case 9:
                                $('#titulo-seccion-nominados').text('MEJOR GUIÓN ADAPTADO');
                                break;
                            case 10:
                                $('#titulo-seccion-nominados').text('MEJOR PELÍCULA DE HABLA NO INGLESA');
                                break;
                            case 11:
                                $('#titulo-seccion-nominados').text('MEJOR DISEÑO DE PRODUCCIÓN');
                                break;
                            case 12:
                                $('#titulo-seccion-nominados').text('MEJOR FOTOGRAFÍA');
                                break;
                            case 13:
                                $('#titulo-seccion-nominados').text('MEJOR VESTUARIO');
                                break;
                            case 14:
                                $('#titulo-seccion-nominados').text('MEJOR MONTAJE');
                                break;
                            case 15:
                                $('#titulo-seccion-nominados').text('MEJORES EFECTOS VISUALES');
                                break;
                            case 16:
                                $('#titulo-seccion-nominados').text('MEJOR MAQUILLAJE Y PELUQUERÍA');
                                break;
                            case 17:
                                $('#titulo-seccion-nominados').text('MEJOR EDICIÓN DE SONIDO');
                                break;
                            case 18:
                                $('#titulo-seccion-nominados').text('MEJOR MEZCLA DE SONIDO');
                                break;
                            case 19:
                                $('#titulo-seccion-nominados').text('MEJOR BANDA SONORA');
                                break;
                            case 20:
                                $('#titulo-seccion-nominados').text('MEJOR CANCIÓN');
                                break;
                            case 21:
                                $('#titulo-seccion-nominados').text('MEJOR DOCUMENTAL');
                                break;
                            case 22:
                                $('#titulo-seccion-nominados').text('MEJOR CORTOMETRAJE');
                                break;
                            case 23:
                                $('#titulo-seccion-nominados').text('MEJOR CORTO DOCUMENTAL');
                                break;
                            case 24:
                                $('#titulo-seccion-nominados').text('MEJOR CORTOMETRAJE ANIMADO');
                                break;
                            default:
                                $('#titulo-seccion-nominados').text('MEJOR PELÍCULA');
                                $("#enlaceNext").addClass("hidden");
                                break;
                        }
               }
	});
}


function vota(){
    $("#portfolio input").each(function () 
        { 
            var myId = $(this).attr("id");
            alert(myId);
            if( $(this).prop('checked') ) {
                alert('Seleccionado');
            }
        }); 
}

function validarUsuario(){
 
  $.ajax({
		type: "POST",
		url: "validaUsuario.php",
		data: { "emailUsuario" :  $("#inputEmail").val() , "nickUsuario" : $("#inputNick").val() },
		success: function(data){
                       if(data!="0"){
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
