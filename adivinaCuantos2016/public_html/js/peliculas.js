$(document).ready(function(){
   inicializaPeliculas(); 
});

function inicializaPeliculas(){
    $("#enlacePrev").addClass("hidden");
    $("#imgCargando").removeClass("hidden");
    //$('#titulo-seccion-nominados').text('Mejor Película (Best picture)');
    try
    { 
        $.ajax({
            type: "POST",
            url: "webservice/adivinaCuantos.php",
            data: { "dameNominaciones" :  true , "idSeccion" :  1},
            success: function(data){
                $("#textoFichas").html(data);
                    //$('#titulo-seccion-nominados').text('Mejor Película (Best picture)');
                    $('#lblSeccion').text(1);
                    $("#imgCargando").addClass("hidden");
            }
        });
    } 
    catch (err) 
    {
      alert(err);
    }
 }

function cargaPeliculas(siguienteSeccion){
    var idSeccion = parseInt($('#lblSeccion').text());
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
    
    try
    { 
        $.ajax({
            type: "POST",
            url: "webservice/adivinaCuantos.php",
            data: { "dameNominaciones" :  true , "idSeccion" :  idSeccion},
            success: function(data){
                $("#imgCargando").addClass("hidden");
                $("#textoFichas").html(data);
                $('#lblSeccion').text(idSeccion);
            }
        });
    } 
    catch (err) 
    {
      alert(err);
    }
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
                var idSeccion = parseInt($('#lblSeccion').text());
                try
                { 
                    $.ajax({
                        type: "POST",
                        url: "webservice/adivinaCuantos.php",
                        data: { "agregaVotacion" :  true , "idNominacion10" : nNominacion10, "idNominacion5" : nNominacion5 , "idCategoria" : idSeccion },
                        success: function(data){
                            alert(data);
                        }
                    });
                } 
                catch (err) 
                {
                  alert(err);
                }
                cargaPeliculas(1);
            }
        }else{
            alert("Tienes que votar con 10 y 5 puntos.");
        }
        
}

function validarUsuario(){
    try
    { 
        $.ajax({
            type: "POST",
            url: "webservice/adivinaCuantos.php",
            data: { "validaUsuario" :  true , "emailUsuario" :  $("#inputEmail").val() , "nickUsuario" : $("#inputNick").val() },
            success: function(data){
                if(data!=="0"){
                    $("#inputEmail").val("");
                    $("#inputNick").val("");
                    $('#usuarios').modal('hide');
                    $('html, body').animate({
                        scrollTop: ($("#contact-section").offset().top - $("#main-navbar").height()) 
                      }, 1000);
                    inicializaPeliculas();
                }else{
                    alert("Usuario No Encontrado");
                }
            }
        });
    } 
    catch (err) 
    {
      alert(err);
    }
 }
