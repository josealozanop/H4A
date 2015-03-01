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
		var touched = false;

		$('#inText-navbar-search').click(function(){
			if(!touched){
				touched = true;
				connect_DB('getMyUsers').success(
					function(out){
						var myUsers = JSON.parse(out);

						var names = new Array();
						for (i in myUsers){
							names.push(myUsers[i].nombre_usuario);
						}
						
						for (i in names){
							$('#datalist-navbar-searchList').append("<option value='"+names[i]+"'></option>");
						}
						
					}
					
				);
			}
		});
			
		
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

