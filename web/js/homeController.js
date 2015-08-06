app.controller('homeController', function($scope, $attrs, $filter, $window, $http, $timeout, $rootScope, screenService) {

	var init = function(){
		var jsonData = $attrs.userData;
		var rawData = angular.fromJson(window.atob(jsonData));
		$scope.rooms = rawData.rooms;
		$scope.rooms.push({
			type : "salir"
		});
		
		$scope.config = rawData.config;
		$scope.layout = rawData.layout;
		$scope.sensors = rawData.sensors;
		
		
		for(i in $scope.sensors){
			var sensor = $scope.sensors[i];
			if(sensor.TipoValor == '0' && sensor.Valor == 1){
				sensor.imgNotActive = sensor.img;
				sensor.img = sensor.imgActive;
			}
		}
		
		$scope.sectionControll = {
			selected : 0,
			names : ["rooms", "sensors", "digitalSensor", "analogicSensor", "sensorsData"]
		}
		
		$scope.page = 0;
		$scope.roomSelected = null;
		
		$scope.needNavigation = $scope.getNeedNavigation($scope.rooms.length);
		$scope.position = $scope.getInitialLayout();
		$scope.filas = $scope.getFilas();
		$scope.cols = $scope.getCols();
		$scope.nPages = $scope.getNpages($scope.rooms.length);
		
		$scope.scanning = {
			activated : false,
			miliseconds : 1800,
			position : 0,
			leftArrow : false,
			rightArrow : false
		}
		
		$scope.buttonSize = {
			width : $scope.getButtonWidth(),
			height : $scope.getButtonHeight()
		}
		
		if($scope.scanning.activated){
			//console.log("activado")
			$scope.tick();
			$scope.tickBarProgress();
		}
		
		//Poner a true si queremos que la web 'funcione' sin internet
		$scope.offline = false;
	}
	
	$scope.reset = function(){
		if($scope.scanning.activated){
			$scope.scanning.position = 0;
		}
		$scope.page = 0;
		$scope.roomSelected = null;
		$scope.nPages = $scope.getNpages($scope.rooms.length);
		$scope.needNavigation = $scope.getNeedNavigation($scope.rooms.length);
	}
	
	/**
	* Demonios
	**/
	
	$scope.tick = function() {
		$scope.lastTickTime = (new Date()).getTime();
		$scope.barPercent = 0;
		//console.log($scope.lastTickTime);
		
		if($scope.sectionControll.selected != 4){
			$scope.scanning.leftArrow = false;
			$scope.scanning.rightArrow = false;
					
			if(!$scope.isLastPage()){
				var module = $scope.filas * $scope.cols;
			}
			else{
				if($scope.sectionControll.selected == 0){
					var items = $scope.rooms.length;
				}
				else if($scope.sectionControll.selected == 1){
					var items = $scope.roomSensors.length;
				}
				else if($scope.sectionControll.selected == 2){
					var items = $scope.sensorStates.length;
				}
				
				var module = items - ($scope.page * $scope.filas * $scope.cols);
			}
					
			var extra = 0;
			if($scope.needNavigation){
				if($scope.isLastPage() || $scope.isFirstPage()){
					extra = 1;
				}
				else{
					extra = 2;
				}
			}
			
			$scope.scanning.position = ($scope.scanning.position + 1) % (module + extra);
			//console.log($scope.scanning.position, module, extra);
						
			if($scope.needNavigation){
				if($scope.isLastPage()){
					if($scope.scanning.position == module){
						$scope.scanning.leftArrow = true;
					}
				}
				else if($scope.isFirstPage()){
					if($scope.scanning.position == module){
						$scope.scanning.rightArrow = true;
					}
				}
				else{
					if($scope.scanning.position == module){
						$scope.scanning.leftArrow = true;
					}
					else if($scope.scanning.position == module+1){
						$scope.scanning.rightArrow = true;
					}
				}
			}
		}
		else if($scope.sectionControll.selected == 4){
			if($scope.needNavigation){
				if(!$scope.isLastPage() && !$scope.isFirstPage()){
					//console.log("pagina intermedia II");
					if($scope.scanning.leftArrow == true){
						$scope.scanning.leftArrow = false;
						$scope.scanning.rightArrow = true;
					}
					else if($scope.scanning.rightArrow == true){
						$scope.scanning.rightArrow = false;
						$scope.scanning.leftArrow = true;
					}
					//console.log($scope.scanning.leftArrow, $scope.scanning.rightArrow);	
				}
				else if($scope.isFirstPage()){
					$scope.scanning.rightArrow = true;
				}
				else if($scope.isLastPage()){
					//var index = indexExitItem();
					if($scope.scanning.exit){
						$scope.scanning.leftArrow = true;
						$scope.scanning.position = -1;
						$scope.scanning.exit = false;
					}
					else{
						$scope.scanning.leftArrow = false;
						
						var salirItemIndex = indexExitItem($scope.roomSensors);
						if(salirItemIndex > -1){
							$scope.scanning.position = salirItemIndex;
							//console.log($scope.scanning.position);
						}
						$scope.scanning.exit = true;
					}	
				}
			}
		}
		//console.log($scope.scanning.position);
		$timeout($scope.tick, $scope.scanning.miliseconds); 
    }
	
	$scope.tickBarProgress = function(){
		var currentTime = (new Date()).getTime();
		var diff = currentTime - $scope.lastTickTime;
		$scope.barPercent = (diff*100)/$scope.scanning.miliseconds;
		$timeout($scope.tickBarProgress, 20); 
	}
	
	var refreshOnlyReadSensors = function(idsSensors){
		if(!$scope.offline){
			getSensorsValues(idsSensors);
		}
		else{
			for(i in $scope.roomSensors){
				var sensor = $scope.roomSensors[i];
				if(sensor && sensor.type != 'salir'){
					var max = sensor.valor_max;
					var min = sensor.valor_min;
					var newValue = randi(min, max);
					console.log(newValue);
					sensor.Valor = newValue;
				}
			}
		}
		
		//Mientras estemos en la pantalla de sensores refrescamos los valores
		if($scope.sectionControll.selected == 4){
			$timeout(function(){refreshOnlyReadSensors(idsSensors)}, 3000);
		}
	}
	
	$scope.clickOnScanning = function(){
				
		if($scope.scanning.rightArrow){
			$scope.clickNext();
			$scope.scanning.rightArrow = false;
			if($scope.sectionControll.selected == 4){
				onlyReadNavigationStart();
			}
		}
		else if($scope.scanning.leftArrow){
			$scope.clickPrevious();
			$scope.scanning.leftArrow = false;
			if($scope.sectionControll.selected == 4){
				onlyReadNavigationStart();
			}
		}
		else{
			var index = $scope.scanning.position + $scope.page * $scope.filas * $scope.cols;
			if($scope.sectionControll.selected == 0){
				var selectedItem = $scope.rooms[index];
				$scope.clickRoom(selectedItem);
			}
			else if($scope.sectionControll.selected == 1){
				var selectedItem = $scope.roomSensors[index];
				$scope.clickSensor(selectedItem);
			}
			else if($scope.sectionControll.selected == 2){
				var selectedItem = $scope.sensorStates[index];
				$scope.clickNewState(selectedItem);
			}
			else if($scope.sectionControll.selected == 4){
				//El úniso caso posible en los sensores de sólo lectura es que el botón de atrá este seleccionado
				$scope.backToRooms();
			}
		}
	}
	
	/**
	* Async calls
	**/
	
	var getSensorsValues = function(idsSensors){
		if(!$scope.offline){
			/*
				Hacemos una petición asíncrona del valor de los sensores paginados de la habitacion
			*/
			dataToSend = window.btoa(angular.toJson({
				action : "getSensors",
				data : idsSensors
			}));
			
			$http.post("/H4A/src/Controllers/asyncSensorController.php", dataToSend).
			then(function(data, status, headers, config) {
				var requestData = data.data;
				var requestStatus = requestData.status;
				/*
					Si la peticion de datos ha tenido exito
					actualizamos los valores de los sensores 
				*/
				if(requestStatus == 1){
					var sensorsValues = requestData.data;
					//console.log(sensorsValues);
					for(i in sensorsValues){
						var value = sensorsValues[i];
						$scope.roomSensors[i].Valor = value;
					}
					//console.log($scope.roomSensors);
				}
				else{
					console.log("Error al obtener valor de los sensores: ", idsSensors, status)
				}
			});
		}
	}
	
	var set2StateSensor = function(newValue, sensor){
		if(!$scope.offline){
			dataToSend = window.btoa(angular.toJson({
				action : "setSensor",
				id : sensor.id_sen,
				value : newValue
			}));
			
			$http.post("/H4A/src/Controllers/asyncSensorController.php", dataToSend).
			then(function(data, status, headers, config){
				var requestData = data.data;
				var requestStatus = requestData.status;
				
				if(requestStatus == 1){
					if(sensor.Valor == 0){
						sensor.imgNotActive = sensor.img;
						sensor.img = sensor.imgActive;
					}
					else{
						sensor.img = sensor.imgNotActive;
					}
					sensor.Valor = newValue;
				}
				else{
					console.log("Error al modificar el valor del sensor");
				}
			});
		}
		
		else{
			if(sensor.Valor == 0){
				sensor.imgNotActive = sensor.img;
				sensor.img = sensor.imgActive;
			}
			else{
				sensor.img = sensor.imgNotActive;
			}
			sensor.Valor = newValue;
		}
	}
	
	var setNStateSensor = function(newValue){
		if(!$scope.offline){
			dataToSend = window.btoa(angular.toJson({
				action : "setSensor",
				id : $scope.selectedNStateSensor.id_sen,
				value : newValue
			}));
			
			$http.post("/H4A/src/Controllers/asyncSensorController.php", dataToSend).
			then(function(data, status, headers, config) {
				var requestData = data.data;
				var requestStatus = requestData.status;
				
				if(requestStatus == 1){
					
				}
				else{
					console.log("Error al modificar el valor del sensor");
				}
			});
			$scope.backToSensors();
		}
		else{
			$scope.selectedNStateSensor.Valor = newValue;
			$scope.backToSensors();
		}
	}
	
	/**
	* Watchers
	**/
	
	$scope.$watch("sectionControll.selected", function(){
		
		//Selección de habitacion
		if($scope.sectionControll.selected == 0){
			//console.log("entro");
			$scope.reset();
		}
		
		//Selección de sensor dentro de una habitación
		else if($scope.sectionControll.selected == 1){
			//$scope.reset();
			$scope.roomSensors = $scope.sensors.filter(function(sensor){
				//console.log(sensor);
				if(sensor.id_habitacion == $scope.selectedRoom.id_habitacion && sensor.Tipo == "Actuador"){
					return sensor;
				}
			});
			
			var onlyReadSensors = $scope.sensors.filter(function(sensor){
				//console.log(sensor);
				if(sensor.id_habitacion == $scope.selectedRoom.id_habitacion && sensor.Tipo == "Sensor"){
					return sensor;
				}
			});
			if(onlyReadSensors.length > 0){
				$scope.roomSensors.push({
					type : "onlyReadSensors"
				});
			}
			
			$scope.roomSensors.push({
				type : "salir"
			});
			
			var idsSensors = [];
			for(i in $scope.roomSensors){
				var sensor = $scope.roomSensors[i];
				if(sensor.id_sen > -1){
					idsSensors.push(sensor.id_sen);
				}
			}
			
			getSensorsValues(idsSensors);
			
			$scope.nPages = $scope.getNpages($scope.roomSensors.length);
			$scope.needNavigation = $scope.getNeedNavigation($scope.roomSensors.length);
			$scope.page = 0;
			
			if($scope.scanning.activated){
				$scope.scanning.position = 0;
			}
		}
		
		//Sección de sensores de nEstados
		else if($scope.sectionControll.selected == 2){
			//$scope.reset();
			var start = parseInt($scope.selectedNStateSensor.valor_min);
			var end = parseInt($scope.selectedNStateSensor.valor_max);
			var inc = parseInt($scope.selectedNStateSensor.incremento);
			//console.log(start, end, inc);
			$scope.sensorStates = [];
			for(i = start; i <= end; i = i+inc){
				//console.log(i);	
				$scope.sensorStates.push(i);
			}
			$scope.sensorStates.push({
				type : "salir"
			});
			
			$scope.nPages = $scope.getNpages($scope.sensorStates.length);
			$scope.needNavigation = $scope.getNeedNavigation($scope.sensorStates.length);
			if($scope.scanning.activated){
				$scope.scanning.position = 0;
			}
		}
		
		//Sección de sensores de sólo lectura.
		else if($scope.sectionControll.selected == 4){
			//$scope.reset();
			//console.log("Sección 4");
			$scope.roomSensors = $scope.sensors.filter(function(sensor){
				//console.log(sensor);
				if(sensor.id_habitacion == $scope.selectedRoom.id_habitacion && sensor.Tipo == "Sensor"){
					return sensor;
				}
			});
			var idsSensors = [];
			for(i in $scope.roomSensors){
				var sensor = $scope.roomSensors[i];
				if(sensor.id_sen > -1){
					idsSensors.push(sensor.id_sen);
				}
			}
			
			$scope.roomSensors.push({
				type : "salir"
			});
						
			getSensorsValues(idsSensors);
			
			$scope.nPages = $scope.getNpages($scope.roomSensors.length);
			$scope.needNavigation = $scope.getNeedNavigation($scope.roomSensors.length);
			$scope.page = 0;
			
			onlyReadNavigationStart();
			refreshOnlyReadSensors(idsSensors);
		}
	})

	/*$scope.$watch("page", function(){
		if($scope.isLastPage()){
			
		}
	})*/
	
	/**
	* Listeners
	**/
	
	$rootScope.$on("screenChange", function(context, data){
		$scope.position = data.position;
		
		if($scope.sectionControll.selected == 0){
			$scope.needNavigation = $scope.getNeedNavigation($scope.rooms.length);
		}
		else if($scope.sectionControll.selected == 1){
			$scope.needNavigation = $scope.getNeedNavigation($scope.roomSensors.length);
		}
		else if($scope.sectionControll.selected == 2){
			$scope.needNavigation = $scope.getNeedNavigation($scope.sensorStates.length);
		}
		else if($scope.sectionControll.selected == 4){
			$scope.needNavigation = $scope.getNeedNavigation($scope.roomSensors.length);
		}
			

		$scope.filas = $scope.getFilas();
		$scope.cols = $scope.getCols();		
		$scope.scanning.position = 0;
		$scope.nPages = $scope.getNpages($scope.rooms.length);
		
		$scope.buttonSize = {
			width : $scope.getButtonWidth(),
			height : $scope.getButtonHeight()
		}
		$scope.$apply();
	})
	
	/**
	* Getters
	**/
	
	$scope.getNeedNavigation = function(items){
		
		var cols = $scope.getCols();	
		var filas =  $scope.getFilas();
		
		var nSlots = parseInt(filas) * parseInt(cols);
		//console.log(nSlots, nRooms);
		if(nSlots < items){
			return 1;
		}
		else{
			return 0;
		}
	}
	
	$scope.getFilas = function(){
		var filas = $scope.layout.filas_horizontal;
		if($scope.position == "vertical"){
			filas = $scope.layout.filas_vertical;
		}
		return parseInt(filas);
	}
	
	$scope.getCols = function(){
		var cols = $scope.layout.columnas_horizontal;
		if($scope.position == "vertical"){
			cols = $scope.layout.columnas_vertical;
		}
		return parseInt(cols);
	}
	
	$scope.getScreenPosition = function(){
		return $scope.position;
	}
	
	$scope.getInitialLayout = function(){
		var width  = angular.element(window).width();
		var height = angular.element(window).height();
		if(height > width){
			return "vertical";
		}
		else{
			return "horizontal";
		}
	}
	
	$scope.getLimitedText = function(text){
		if(text){
			var max = text.length;
			var screen = screenService.getScreenSize();
			var shortName = false;
			
			switch(screen){
				case "xs":
					if(max > 9){
						max = 7;
						shortName = true;
					}	
				break;
				
				case "sm" :
					if(max > 12){
						max = 10;
						shortName = true;
					}
				break;
				
				case "md" :
					if(max > 16){
						max = 14;
						shortName = true;
					}
				break;
				
				case "lg" : 
					if(max > 18){
						max = 16;
						shortName = true;
					}
				break;
			}
			
			var result = text.substring(0, max);
			if(shortName){
				result += "...";
			}
			
			return result;
		}
	
	}

	$scope.isCurrentScanned = function(index){
		//console.log(index, $scope.scanning.position)
		if($scope.scanning.activated && index == $scope.scanning.position){
			return true;
		}
		else{
			return false;
		}
	}
	
	$scope.isFirstPage = function(){
		if($scope.page == 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	$scope.isLastPage = function(){
		//console.log($scope.page, $scope.nPages);
		if($scope.page == $scope.nPages - 1){
			return true;
		}
		else{
			return false;
		}
	}
	
	$scope.isScanning = function(){
		if($scope.scanning.activated){
			return true;
		}
		else{
			return false;
		}	
	}
	
	$scope.getNpages = function(items){
		return Math.ceil((items	) / ($scope.filas * $scope.cols));
	}
	
	$scope.getButtonHeight = function(){
		/*var margin = [3, 3, 2, 1.8, 1.5];
		var index = $scope.filas;
		if($scope.filas >= margin.length){
			index = margin.length-1;
		}
		return (100/$scope.filas)-margin[index];*/
		return (100/$scope.filas);
	}
	
	$scope.getButtonWidth = function(){
		return 100/$scope.cols;
	}
	
	$scope.clickNext = function(){
		
		if($scope.page+1 < $scope.nPages){
			$scope.scanning.position = 0;
			$scope.page += 1;
		}
	}
	
	$scope.clickPrevious = function(){
		
		if($scope.page > 0){
			$scope.scanning.position = 0;
			$scope.page -= 1;
		}		
	}
	
	$scope.clickRoom = function(room){
		
			if(room.type != 'salir'){
				$scope.selectedRoom = room;
				$scope.page = 0;
				$scope.sectionControll.selected = 1;
			}
			else{
				$window.location.href = '/H4A/web/userSelection';
			}
		
	}
	
	$scope.showButton = function(index, max){
		//console.log(index,  $scope.rooms.length)
		if(index < max){
			return 1;
		}
		else {
			return 0;
		}
	}
	
	$scope.clickSensor = function(sensor){
			if(sensor.type == "salir"){
				$scope.backToRooms();
			}
			else if(sensor.type == 'onlyReadSensors'){
				$scope.sectionControll.selected = 4;
			}
			else{
				switch(sensor.TipoValor){
					case '0':
						click2stateSensor(sensor);
					break;
					
					case '1':
						clickNstateSensor(sensor);
					break;
					
					case '2':
						clickAnalogicSensor(sensor);
					break;
				}
			}
	}

	var click2stateSensor = function(sensor){
		var newValue = 0;
		if(sensor.Valor == 0){
			newValue = 1;
		}
		
		set2StateSensor(newValue, sensor);
	}
	
	var clickNstateSensor = function(sensor){
		$scope.sectionControll.selected = 2;
		$scope.selectedNStateSensor = sensor;
		//console.log("sensor de n estados");
	}
	
	var clickAnalogicSensor = function(sensor){
		console.log("sensor analógico");
	}
	
	$scope.clickNewState = function(newValue){
		//console.log(newValue);
		if(newValue.type == "salir"){
			$scope.backToSensors();
		}
		else{			
			setNStateSensor(newValue);
		}
	}
	
	$scope.isCurrentSensorValue = function(value){
		if(value == $scope.selectedNStateSensor.Valor){
			return true;
		}
		else{
			return false;
		}
	}
	
	$scope.isSensorActive = function(sensor){
		if(sensor && sensor.TipoValor == '0' && sensor.Valor != 0){
			//console.log(sensor);
			return true;
		}
		else{
			return false;
		}
	}
	
	$scope.backToRooms = function(){
		$scope.sectionControll.selected = 0;
	}
	
	$scope.backToSensors = function(){
		console.log("volviendo a los sensores");
		$scope.sectionControll.selected = 1;
	}
	
	$scope.parseSensorValue = function(sensor){
		if(sensor){
			if(sensor.type != 'salir' && sensor.TipoValor == '0'){
				if(sensor.Valor == 0){
					return 'OFF';
				}
				else{
					return 'ON';
				}
			}
			else{
				return sensor.Valor;
			}
		}
	}
	
	/**
	* Navegación
	**/
	var onlyReadNavigationStart = function(){
		if($scope.scanning.activated){
			if($scope.needNavigation){
				//console.log("Sección 4 y barrido");
				if($scope.isFirstPage()){
					$scope.scanning.position = -1;
					$scope.scanning.rightArrow = true;
				}
				else if($scope.isLastPage()){
					$scope.scanning.exit = true;
					var salirItemIndex = indexExitItem($scope.roomSensors);
					if(salirItemIndex > -1){
						$scope.scanning.position = salirItemIndex;
					}
					//console.log($scope.scanning.position);
				}
				else{
					//console.log("pagina intermedia");
					$scope.scanning.position = -1;
					$scope.scanning.leftArrow = true;
				}
			}
			else{
				var salirItemIndex = indexExitItem($scope.roomSensors);
				if(salirItemIndex > -1){
					$scope.scanning.position = salirItemIndex;
				}
			}
		}	
	}
	
	var indexExitItem = function(items){
		for(i in items){
			var item = items[i];
			if(item.type == "salir"){
				var mod = $scope.page * $scope.getFilas() * $scope.getCols();
				if(mod == 0){
					return i;
				}
				else{
					return i % mod;
				}

			}
		}
		return -1;
	}
	
	var onlyReadNavigationRefresh = function(){
		
	}
	
	
	/**
	*	Funciones auxiliares.
	**/
		
	$scope.getButtonIndex = function(fila, col){
		return getUnidimensionalIndex(fila, col, $scope.cols, $scope.page, $scope.filas*$scope.cols)
	}
	
	$scope.range = range;
		
	$scope.debug = function(){
		console.log("Cargando homeController...");
		console.log($scope);
		//console.log($scope.rooms);
	}
	
	init();
	
	$scope.debug();
});