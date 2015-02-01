$(document).ready(function(){
	todo();
	smart_search();
});

function smart_search(){
		
		$('#inText-navbar-search').click(function(){
		 $.ajax({
                type: "GET",
                url: "get/tutors",
                data: '',
                success: function(msg){
                    var todos = JSON.parse(msg);
					var usuarios = todos[0];
					var tutores = todos[1];
					var names = new Array();
					
					for (i in tutores){
						names.push(tutores[i].nUsuario_tutor+' (tutor)');
					}
					
					for (i in usuarios){
						names.push(usuarios[i].nUsuario_usuario+' (usuario)');
					}
					
					for (i in names){
						$('#datalist-navbar-searchList').append("<option value='"+names[i]+"'></option>");
						//console.log(names[i]);
					}
                }
            }); // Ajax Call
		});
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
    if (confirm('Estas seguro de eliminar ese usuario?')){ 
       document.tuformulario.submit() 
    } 
} 