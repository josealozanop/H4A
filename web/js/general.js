$(document).ready(function(){
	/*declaracion de la variables de sesion, variables javascript que se pueden usar en toda la web*/
	sessionStorage.setItem("newTutor_name", "");
	sessionStorage.setItem("newTutor_mail", "");
	todo();
	$('#inicio_newTutor').click({name:'test'},newTutor2);
	PONLE_UN_NOMBRE();
});

function newTutor2(){
	sessionStorage.newTutor_name = $('#inicio_newTutor_name').val();
	sessionStorage.newTutor_mail = $('#inicio_newTutor_mail').val();
	window.location.replace("newTutor");
}

function todo(){
	$("#bprimario").click(function(){
		if($("#Ingreso").attr('class')!='hola'){
			$("#Ingreso").show('slow','linear');
			$("#Ingreso").addClass('hola');
		}
		else{
			$("#Ingreso").hide('hide');
			$("#Ingreso").removeClass('hola');
		}
	/*if($("#Ingreso").css("display")=="none"){
		estado="inline";
	}
	else{
		estado="none";
	}
	$("#Ingreso").css("display",estado)*/
	
});

$("#bsecundario").click(function(){
	if($("#Registro").css("display")=="none"){
		estado="inline";
	}
	else{
		estado="none";
	}
	$("#Registro").css("display",estado)
	
});
}
function pregunta(){ 
       var agree=confirm("¿Realmente desea eliminarlo? ");
  if (agree) return true ;
  return false;
} 

//ME CAGO EN TI, a ver si vamos con mas cuidado

function PONLE_UN_NOMBRE() {
	$("#boton_usuario").click(function (){ //función para el boton de enviar
        //recolectamos en variables, lo que tenga cada input.
        //Para mejor manipulación en los if's
        var passw = $("#pass").val();
        var repass = $("#repass").val();   
		if(passw == ""){
			$("#mensaje1").fadeIn("slow");
			return false;
		}
		else{
			if(passw != repass){
				$("#mensaje2").fadeIn("slow");
				return false;
			}
		}
    });//fin click
	var valido=false;
	$("#pass").change(function() {
		$("#divValidacion").fadeIn("slow");
		var passw = $("#pass").val();
		$("#divValidacion").fadeIn("slow");
		document.getElementById("repass").value="";
	})
	var valido=false;
	$("#repass").keyup(function() {
        var pass = $("#pass").val();
        var re_pass=$("#repass").val();
 
        if(pass != re_pass)
        {
            $("#repass").css({"background":"#F22" }); //El input se pone rojo
            valido=true;
        }
        else if(pass == re_pass)
        {
            $("#repass").css({"background":"#8F8"}); //El input se ponen verde
            $("#mensaje4").fadeOut();
            valido=true;
        }
    });//fin keyup repass
}


