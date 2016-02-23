$(document).ready(function(){
   inicializaNominaciones();
   inicializaUsuarioLogado();
 });

function alertaPanel(texto){
    $("#textoAlertaPanel").html('');
    $("#textoAlertaPanel").html(texto);
    $('#alertPanel').modal('show');
    
}


function inicializaUsuarioLogado(){
    try
    { 
        $.ajax({
            type: "POST",
            url: "webservice/adivinaCuantos.php",
            data: { "dameUsuarioLogado" :  true },
            success: function(data){
                $("#spanLogin").text('');
                $("#spanLogin").text(data);
            }
        });
    } 
    catch (err) 
    {
      alert(err);
    }
    
}


function inicializaNominaciones(){
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

function cargaNominaciones(){
    $("#imgCargando").removeClass("hidden");
    $("#textoFichas").html('');
    setTimeout(webserviceNominaciones, 2000);
   
 }
 
 function webserviceNominaciones(){
      try
    { 
        $.ajax({
            type: "POST",
            url: "webservice/adivinaCuantos.php",
            data: { "dameNominaciones" :  true },
            success: function(data){
                $("#imgCargando").addClass("hidden");
                $("#textoFichas").html(data);
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
                alertaPanel('<p>Uno como 1ª opción que te haría sumar 10 <span class="fa fa-star"></span>, y otro distinto como 2ª opción que te sumaría 5 <span class="fa fa-star"></span>.</p>');
             }else{
                var idSeccion = parseInt($('#lblSeccion').text());
                try
                { 
                    $.ajax({
                        type: "POST",
                        url: "webservice/adivinaCuantos.php",
                        data: { "agregaVotacion" :  true , "idNominacion10" : nNominacion10, "idNominacion5" : nNominacion5 , "idCategoria" : idSeccion },
                        success: function(data){
                            //alert(data);
                        }
                    });
                } 
                catch (err) 
                {
                  alert(err);
                }
                cargaNominaciones();
            }
        }else{
            alertaPanel('<p>No has seleccionado ninguna <span class="fa fa-star"></span>, o sólo una.</p><p>Tienes que pinchar en 10 <span class="fa fa-star"></span> para fijar tu 1ª opción, y en 5 <span class="fa fa-star"></span> para la 2ª opción.</p>');
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
                $("#spanLogin").text('');
                $("#spanLogin").text(data);
                if(data!=="LOGIN"){
                    $("#inputEmail").val("");
                    $("#inputNick").val("");
                    $('#usuarios').modal('hide');
                    $('html, body').animate({
                        scrollTop: ($("#contact-section").offset().top - $("#main-navbar").height()) 
                      }, 1000);
                    cargaNominaciones();
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
