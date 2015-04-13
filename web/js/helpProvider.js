app.service('helpProvider',['$filter',function($filter){
	
	var help = [
	
		{
			id : "h4all",
			title : "¿Qué es h4all?",
			body : [
				"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, esse nobis dignissimos. Veritatis, obcaecati corporis amet eligendi est quod incidunt nihil exercitationem. Atque, tempore quas vel obcaecati quidem modi facere.",
				"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, optio, nam dicta perferendis amet quisquam accusantium eaque quo ipsam deserunt omnis fugit! Culpa, illo quasi ex ea quod placeat exercitationem.",
				"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit, vel, modi, deserunt natus consequuntur accusamus nobis laboriosam et perferendis itaque alias aperiam ipsa quisquam impedit dolores eum quia tenetur consequatur."
			],
			tags : [ 
				"#general"
			],
			relations : [
				"tutor",
				"user",
				"device"
			]
		},
		
		{
			id : "helpSystem",
			title : "Bienvenido al sistema de ayuda de h4all",
			body : [ 
				"Aquí podrá aprender todo lo necesario para comenzar a usar h4all. En la parte superior tiene la barra de navegación, en ella podrá ver el menú de navegación, buscar un tema concreto o acceder a la configuración de la ayuda.",
				"Cada vez que acceda a un articulo de ayuda este aparecerá en la primera posición, prueba a hacer click <a class=\"helpLink\" id=\"h4all\" >aqui.</a>",
				"Para cerrarlo tan solo haga click en el icono de cerrar situado en la parte superior derecha."
			],
			tags : [ 
				"#inicio",
				"#ayuda"
			],
			relations : [
				"h4all"
			]
		},
		
		{
			id : "tutor",
			title : "Tutor",
			body : [ 
				"Es la persona encargada de la gestión de los usuarios: crearlos, asignarles dispositivos... Puede haber tantos tutores como queramos, cada uno de ellos podrá tener tantos usuarios como desee."
			],
			tags : [ 
				"#tutor",
				"#inicio"
			],
			relations : [
				"user",
				"device",
				"tutorPanel"
			]
		},
		
		{
			id : "user",
			title : "Usuario",
			body : [ 
				"Es es actor principal de nuestra aplicación. Es la persona que mediante el uso de la aplicación gestiona la vivienda/recinto dónde se haya instalado h4all, cada uno de los usuario tendrá definida una configuración de entorno que se adaptará a su diversidad funcional."
			],
			tags : [ 
				"#usuario",
				"#tutor",
				"#inicio"
			],
			relations : [
				"tutor",
				"defaultUser"
			]
		},
		
		{
			id : "device",
			title : "Dispositivos",
			body : [ 
				"Son los dispositivos(ordenadores, móviles, tablets...) desde los que los usuarios entrarán a la aplicación para gestionar la vivienda/recinto."
			],
			tags : [ 
				"#dispositivo",
				"#inicio"
			],
			relations : [
				"howToObtainMAC",
				"whatIsMAC"
			]
		},
		
		{
			id : "tutorPanel",
			title : "Panel del tutor",
			body : [ 
				"Panel que organiza todas las acciones que un tutor puede realizar:<ul><li>Gestión de usuarios</li><li>Gestión de la casa</li><li>Dispositivos</li><li>Datos personales</li></ul><figure><img src=\"../web/images/tutorpanel.jpg\" width=\"80%\"></img><figcaption>Panel del tutor</figcaption></figure>"
			],
			tags : [ 
				"#tutor",
				"#inicio"
			],
			relations : [
				"tutor",
				"device",
				"user"
			]
		},
		
		{
			id : "defaultUser",
			title : "Usuario por defecto",
			body : [ 
				"Un dispositivo puede tener definido un usuario por defecto. Si el dispositivo tiene un usuario por defecto cuando el dispositivo se conecte a h4all el usuario por defecto se logueará automaticamente."
			],
			tags : [ 
				"#MAC",
				"#dispositivos"
			],
			relations : [
				"device",
				"user"
			]
		},
		
		{
			id : "whatIsMAC",
			title : "¿Qué es la MAC?",
			body : [ 
				"En las redes de computadoras, la dirección MAC (siglas en inglés de media access control; en español \"control de acceso al medio\") es un identificador de 48 bits (6 bloques hexadecimales) que corresponde de forma única a una tarjeta o dispositivo de red. Se conoce también como dirección física, y es única para cada dispositivo."
			],
			tags : [ 
				"#MAC",
				"#dispositivos"
			],
			relations : [
				"howToObtainMAC",
				"device"
			]
		},
		
		{
			id : "howToObtainMAC",
			title : "¿Cómo obtener la MAC?",
			body : [ 
				"<b>En linux</b>",
				"<ol><li>Loguearnos/Ingresar como root o usuario con suficientes permisos.</li><li>Abrir una terminal.</li><li>Escribir ifconfig -a y presionar Enter.</li><li>En la información mostrada debemos localizar eth0 (el principal adaptador de red) y a su derecha se encuentra la direcciónHW o HWaddr, que corresponde con la MAC Address.</li></ol>"
			],
			tags : [ 
				"#MAC",
				"#dispositivos"
			],
			relations : [
				"whatIsMAC",
				"device"
			]
		}
	]
	
	this.getAll = function() {
		return help;
	}
	
	this.getInlineHelp = function(i) {
		var helpData = $filter('filter')(help, {id:i}, true);
		console.log(helpData);
		//Cogemos el primer parrafo del único match(los ids son únicos por lo tanto solo debe haber un match)
		return deleteHtmlText(helpData[0].body[0]);
	}
	
	var deleteHtmlText = function(text) {
		return text.replace(/<.*>?/g,"");
	}
	
	this.ping = function(data){
		return "Has ejecutado helpProvider";
	}
	
	return this;

}]);