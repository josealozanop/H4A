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
	$("#pass").keyup(function() {
		$("#divValidacion").fadeIn("slow");
		var passw = $("#pass").val();
		$("#divValidacion").fadeIn("slow");
		document.getElementById("repass").value="";
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


//funcion para la tabla editable de dispositivos que no sirvió
/*
var editando=false;
 
function transformarEnEditable(nodo){
//El nodo recibido es SPAN
if (editando == false) {
	var nodoTd = nodo.parentNode; //Nodo TD
	var nodoTr = nodoTd.parentNode; //Nodo TR
	var nodoContenedorForm = document.getElementById('contenedorForm'); //Nodo DIV
	var nodosEnTr = nodoTr.getElementsByTagName('td');
	var id_disp = nodosEnTr[0].textContent; var nombre = nodosEnTr[1].textContent; var mac = nodosEnTr[2].textContent;
	var usuarioDefec = nodosEnTr[3].textContent; var opciones = nodosEnTr[4].textContent;
	var nuevoCodigoHtml = '<td class="oculto"><input type="text" name="id_disp" id="id_disp" value="'+id_disp+'" size="9"></td>'+
	'<td><input type="text" name="nombre" id="nombre" value="'+nombre+'" size="9"></td>'+
	'<td><input type="text" name="mac" id="mac" value="'+mac+'" size="20"</td>'+
	'<td><input type="text" name="usuarioDefec" id="usuarioDefec" value="'+usuarioDefec+'" size="20"</td>';
	 
	nodoTr.innerHTML = nuevoCodigoHtml;

	nodoContenedorForm.innerHTML = 
	'<form name = "formulario" action="" method="get" onsubmit="capturarEnvio()" onreset="anular()">'+
	'<input class="btn btn-primary btn-lg" type = "submit" value="Aceptar"> <input class="btn btn-primary btn-lg" type="reset" value="Cancelar">';
	editando = "true";
}
else {
	alert ('Solo se puede editar una línea. Recargue la página para poder editar otra');
}
}
 
function capturarEnvio(){

var nodoContenedorForm = document.getElementById('contenedorForm'); //Nodo DIV
nodoContenedorForm.innerHTML = 
'<input type="hidden" name="id_disp" value="'+document.querySelector('#id_disp').value+'">'+
'<input type="hidden" name="nombre" value="'+document.querySelector('#nombre').value+'">'+
'<input type="hidden" name="mac" value="'+document.querySelector('#mac').value+'">'+
'<input type="hidden" name="usuarioDefec" value="'+document.querySelector('#usuarioDefec').value+'">'+
'<input class="btn btn-primary btn-lg" type = "submit" value="Aceptar"> <input class="btn btn-primary btn-lg" type="reset" value="Cancelar">';
document.formulario.submit();
}
 
function anular(){
window.location.reload();
}*/ 
//termina la funcion de tabla editable