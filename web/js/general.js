$(document).ready(function(){
	/*declaracion de la variables de sesion, variables javascript que se pueden usar en toda la web*/
	sessionStorage.setItem("newTutor_name", "");
	sessionStorage.setItem("newTutor_mail", "");
	todo();
	smart_search();
	$('#inicio_newTutor').click({name:'test'},newTutor);
	
});

function newTutor(event){
	inicio_newTutor_mail
	sessionStorage.newTutor_name = $('#inicio_newTutor_name').val();
	sessionStorage.newTutor_mail = $('#inicio_newTutor_mail').val();
	window.location.replace("newTutor");
}

function smart_search(){
		
		$('#inText-navbar-search').click(function(){
			connect_DB('getAllTutorName').success(
				function(out){
					var tutors_name = JSON.parse(out);
					var names = new Array();
					for (i in tutors_name){
						names.push(tutors_name[i].nombre_tutor);
					}
					
					for (i in names){
						$('#datalist-navbar-searchList').append("<option value='"+names[i]+"'></option>");
					}
					
				}
				
			);
			
			
		
		/*$.ajax({
                type: "GET",
                url: "./serviceController",
                data: {service : 'getMyData'},
                success: function(msg){
					console.log(msg);
                    /*var todos = JSON.parse(msg);
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
                },
				error : function(){
					console.log('ha habido un error');
				}
            }); */// Ajax Call

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
       var agree=confirm("¿Realmente desea eliminarlo? ");
  if (agree) return true ;
  return false;
    
} 

