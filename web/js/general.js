$(document).ready(function(){
	todo();
});

function todo(){
	$("#bprimario").click(function(){
	if($("#Ingreso").css("display")=="none"){
		estado="inline";
	}
	else{
		estado="none";
	}
	$("#Ingreso").css("display",estado)
	
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