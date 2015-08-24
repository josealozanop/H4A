app.controller('homeController', function($scope, $attrs, $filter, $window, $http, $timeout, $rootScope, screenService, routeService, speakerService, phraseService) {

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
		$scope.assets = rawData.assets;
		$scope.os = $attrs.os;
		
		//speakerService.speak("esto es una prueba");
		
		//Sensor analógico seleccionado
		$scope.analogic = {
			sensor : null,
			max : 20,
			min : 10,
			step : 1,
			val : 15,
			scanning : {
				section : 0,
				position : 0
			}
		}		
		
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
			miliseconds : 2000,
			position : 0,
			leftArrow : false,
			rightArrow : false
		}
		if($scope.config.barrido == 1){
			$scope.scanning.activated = 1;
			$scope.scanning.miliseconds = $scope.config.tiempo_barrido * 1000;
		}
		
		$scope.voiceFeature = true;
		if($scope.voiceFeature){
			$scope.voiceService = 2;
			speakerService.init(parseInt($scope.os));
		}
		else if($scope.scanning.activated){
			$scope.initScanning();
		}
		
		$scope.buttonSize = {
			width : $scope.getButtonWidth(),
			height : $scope.getButtonHeight()
		}
		
		//Poner a true si queremos que la web 'funcione' sin internet
		$scope.offline = false;
		$scope.debugMode = false;
	}
	
	$scope.initScanning = function(){
		if($scope.scanning.activated){
			//console.log("activado")
			//$scope.tick();
			$scope.lastTickTime = (new Date()).getTime();
			$scope.barPercent = 0;
			$scope.tickPromise = $timeout($scope.tick, $scope.scanning.miliseconds);
			$scope.tickBarProgress();
			if($scope.voiceFeature){
				var posibleChanges = [
					"scanning.position",
					"sectionControll.selected",
					"analogic.scanning.section",
					"analogic.scanning.position",
					"analogic.val"
				];
				$scope.$watchGroup(posibleChanges, function(){
					//console.log($scope.scanning.position);
					var module = $scope.getModule();
					var phrase = $scope.getPhrase(module);
					$scope.mySpeak(phrase);
				})
			}
		}
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
		
		if(watheverValue($scope.sectionControll.selected, [0, 1, 2])){
			$scope.scanning.leftArrow = false;
			$scope.scanning.rightArrow = false;
				
			var module = $scope.getModule();
					
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
		else if($scope.sectionControll.selected == 3){
			//Si estamos en la seccion 0 el barrido pasa por:
			//1) El medidor del valor del actuador
			//2) El botón de salir 
			if($scope.analogic.scanning.section == 0){
				if($scope.analogic.scanning.position == 0){
					$scope.analogic.scanning.position = 1;
				}
				else{
					$scope.analogic.scanning.position = 0;
				}
			}
			
			//Si estamos en la seccion 1 el barrido pasa por:
			//1) Cada una de la 4 divisiones que hemos hecho de la barra de valores
			else if($scope.analogic.scanning.section == 1){
				$scope.analogic.scanning.position = ($scope.analogic.scanning.position + 1) % 4;
			}
			//Si estamos en la seccion 2 el barrido pasa por:
			//1) Por cada uno de los valores posibles de la barra de valores en el cuarto elegido
			else if($scope.analogic.scanning.section == 2){
				$scope.analogic.val = parseInt($scope.analogic.val);
				$scope.analogic.val += 1;
				if($scope.analogic.val == $scope.analogic.currentMax){
					$scope.analogic.val = $scope.analogic.currentMin;
				}
			}
			//console.log("tick de barrido en sensor analogico", $scope.analogic.scanning.section, $scope.analogic.scanning.position);
		}
		//console.log($scope.scanning.position);
		
		$scope.tickPromise = $timeout($scope.tick, $scope.scanning.miliseconds); 
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
		//console.log($scope);
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
				//Si hacemos click sobre un actuador binario entonces hacemos que el barrido no vuelva al principio
				if(selectedItem.TipoValor == '0'){
					return;
				}
			}
			else if($scope.sectionControll.selected == 2){
				var selectedItem = $scope.sensorStates[index];
				$scope.clickNewState(selectedItem);
			}
			else if($scope.sectionControll.selected == 3){
				if($scope.analogic.scanning.section == 2){
					console.log("click en section == 2")
					$scope.analogic.scanning.section = 0;
					$scope.analogic.scanning.position = 0;
					setAnalogicSensor($scope.analogic.val);
					return;
				}
				
				if($scope.isAnalogicBackScanned()){
					$scope.backToSensors();
				}
				else if($scope.isAnalogicRangeScanned()){
					$scope.analogic.scanning.section = 1;
					$scope.analogic.scanning.position = getSplicePosition($scope.analogic.min, $scope.analogic.max, $scope.analogic.val, 4);
				}
				else if($scope.analogicQuarterScanned() == 0){
					$scope.analogic.scanning.section = 2;
					$scope.analogic.val = $scope.analogic.min;
					$scope.analogic.currentMin = $scope.analogic.val;
					$scope.analogic.currentMax = spliceAndPos($scope.analogic.min, $scope.analogic.max, 1, 4);
					//console.log($scope.analogic.val);
				}
				else if($scope.analogicQuarterScanned() == 1){
					$scope.analogic.scanning.section = 2;
					$scope.analogic.val = spliceAndPos($scope.analogic.min, $scope.analogic.max, 1, 4);
					$scope.analogic.currentMin = $scope.analogic.val;
					$scope.analogic.currentMax = spliceAndPos($scope.analogic.min, $scope.analogic.max, 2, 4);
					//console.log($scope.analogic.val);
				}
				else if($scope.analogicQuarterScanned() == 2){
					$scope.analogic.scanning.section = 2;
					$scope.analogic.val = spliceAndPos($scope.analogic.min, $scope.analogic.max, 2, 4);
					$scope.analogic.currentMin = $scope.analogic.val;
					$scope.analogic.currentMax = spliceAndPos($scope.analogic.min, $scope.analogic.max, 3, 4);
					//console.log($scope.analogic.val);
				}
				else if($scope.analogicQuarterScanned() == 3){
					$scope.analogic.scanning.section = 2;
					$scope.analogic.val = spliceAndPos($scope.analogic.min, $scope.analogic.max, 3, 4);
					$scope.analogic.currentMin = $scope.analogic.val;
					$scope.analogic.currentMax = $scope.analogic.max;
					//console.log($scope.analogic.val);
				}
				
				
				
			}
			else if($scope.sectionControll.selected == 4){
				//El úniso caso posible en los sensores de sólo lectura es que el botón de atrás este seleccionado
				$scope.backToSensors();
			}
		}
				
		//Matamos el anterior timeout y empezamos en la posición 0 de la nueva sección
		$timeout.cancel($scope.tickPromise);
		$scope.scanning.position = 0;
		$scope.lastTickTime = (new Date()).getTime();
		$scope.tickPromise = $timeout($scope.tick, $scope.scanning.miliseconds);
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
				sensorsIds : idsSensors
			}));
			
			/*$http.post("/H4A/src/Controllers/asyncSensorController.php", dataToSend).
			then(function(data, status, headers, config) {
				var requestData = data.data;
				var requestStatus = requestData.status;
				
				//Si la peticion de datos ha tenido exito		actualizamos los valores de los sensores 
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
			});*/
			
			$http.get("./getSensorsValues?data="+dataToSend).
			then(function(data, status, headers, config) {
				var requestData = data.data;
				var requestStatus = requestData.status;
				
				//Si la peticion de datos ha tenido exito		actualizamos los valores de los sensores 
				if(requestStatus == 1){
					var sensorsValues = requestData.data.values;
					//console.log(sensorsValues);
					//console.log(requestData.data);
					for(i in sensorsValues){
						var value = sensorsValues[i];
						if($scope.roomSensors[i].Valor){
							$scope.roomSensors[i].Valor = value;
						}
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
				id : sensor.id_sen,
				value : newValue
			}));
			
			/*$http.post("/H4A/src/Controllers/asyncSensorController.php", dataToSend).
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
			});*/
			
			$http.get("./setSensor?data="+dataToSend).
			then(function(data, status, headers, config) {
				var requestData = data.data;
				var requestStatus = requestData.status;
				
				//Si la peticion de datos ha tenido exito		actualizamos los valores de los sensores 
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
					console.log("Error al obtener valor de los sensores: ", idsSensors, status)
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
				id : $scope.selectedNStateSensor.id_sen,
				value : newValue
			}));
			
			/*$http.post("/H4A/src/Controllers/asyncSensorController.php", dataToSend).
			then(function(data, status, headers, config) {
				var requestData = data.data;
				var requestStatus = requestData.status;
				
				if(requestStatus == 1){
					
				}
				else{
					console.log("Error al modificar el valor del sensor");
				}
			});*/
			
			$http.get("./setSensor?data="+dataToSend).
			then(function(data, status, headers, config) {
				var requestData = data.data;
				var requestStatus = requestData.status;
				
				//Si la peticion de datos ha tenido exito		actualizamos los valores de los sensores 
				if(requestStatus == 1){
					
					$scope.selectedNStateSensor.Valor = newValue;
				}
				else{
					console.log("Error al establecer el valor de los sensores: ")
				}
			});
			$scope.backToSensors();
		}
		else{
			$scope.selectedNStateSensor.Valor = newValue;
			$scope.backToSensors();
		}
	}
	
	var setAnalogicSensor = function(newValue){
		console.log("setAnalogicSensor iniciado");
		var sensorId = $scope.analogic.sensor.id_sen;
		if(!$scope.offline){
			dataToSend = window.btoa(angular.toJson({
				id : sensorId,
				value : newValue
			}));
			
			
			$http.get("./setSensor?data="+dataToSend).
			then(function(data, status, headers, config) {
				var requestData = data.data;
				var requestStatus = requestData.status;
				//Si la peticion de datos ha tenido exito actualizamos los valores de los sensores 
				if(requestStatus == 1){
					console.log("setAnalogicSensor realizado con exito");
					
					var changedSensor = $scope.sensors.filter(function(elem){
						if(elem.id_sen == sensorId){
							return true;
						}
					})[0];
					
					changedSensor.Valor = newValue;
				}
				else{
					console.log("Error al establecer el valor de los sensores: ", requestStatus)
				}
			});
		}
		else{
			var changedSensor = $scope.sensors.filter(function(elem){
				if(elem.id_sen == sensorId){
					return true;
				}
			})[0];
			
			changedSensor.Valor = newValue;
		}
	}
	
	/**
	* Watchers
	**/
	
	$scope.$watch("voiceService", function(){
		if($scope.voiceFeature){
			console.log($scope.voiceService)
			if($scope.voiceService != 2){
				$scope.initScanning();
			}
		}
	});
	
	$scope.$watch("sectionControll.selected", function(){
		
		//Selección de habitacion
		if($scope.sectionControll.selected == 0){
			//console.log("entro");
			$scope.reset();
			//$scope.mySpeak($scope.rooms[0].nombre_habitacion);
		}
		
		//Selección de sensor dentro de una habitación
		else if($scope.sectionControll.selected == 1){
			//$scope.reset();
			//console.log("entro")
			$scope.roomSensors = $scope.sensors.filter(function(sensor){
				//console.log(sensor);
				if(sensor.id_habitacion == $scope.selectedRoom.id_habitacion && sensor.Tipo == "Actuador"){
					return sensor;
				}
			});
			
			console.log($scope.roomSensors);
			
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
				//$scope.mySpeak($scope.roomSensors[0].nombre_sensor);
			}
		}
		
		//Sección de actuadores de nEstados
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
				//$scope.mySpeak($scope.sensorStates[0]);
			}
		}
		
		//sección de actuadores analógicos
		else if($scope.sectionControll.selected == 3){
			$scope.nPages = 1;
			$scope.needNavigation = false;
			$scope.analogic.val = $scope.analogic.sensor.Valor;
			$scope.analogic.max = $scope.analogic.sensor.valor_max;
			$scope.analogic.min = $scope.analogic.sensor.valor_min;
			$scope.analogic.step = $scope.analogic.sensor.incremento;
			
			$scope.analogic.scanning = {
				section : 0,
				position : 0
			}
			
			if($scope.scanning.activated){
				//$scope.mySpeak("Cambiar valor");
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
	
	/*$scope.$watch("analogic.val", function(){
		console.log("ejecutando el watcher de analogic.val");
		
		if($scope.analogic.val < $scope.analogic.min){
			$scope.analogic.val = $scope.analogic.min;
		}
		else if($scope.analogic.val > $scope.analogic.max){
			$scope.analogic.val = $scope.analogic.max;
		}
		
		var offset = ($scope.analogic.val-$scope.analogic.min)%$scope.analogic.step;
		console.log(offset, $scope.analogic.val);
		if(offset != 0){
			$scope.analogic.val += offset;
		}
	})*/

	/*$scope.$watch("page", function(){
		if($scope.isLastPage()){
			
		}
	})*/
	
	/**
	* Listeners
	**/
	$rootScope.$on("googleOnline", function(context, data){
		console.log("google está online");
		$scope.voiceService = 1;
		$scope.$apply();
	});
	
	$rootScope.$on("googleOffline", function(context, data){
		console.log("google está offline");
		$scope.voiceService = 0;
		$scope.$apply();
	});
	
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
	$scope.getLinealPosition = function(){
		return $scope.scanning.position + ($scope.filas * $scope.cols * $scope.page);
	}
	
	$scope.getPhrase = function(module){
		if($scope.scanning.leftArrow){
			return "anterior";
		}
		
		if($scope.scanning.rightArrow){
			return "siguiente";
		}

		var index = $scope.scanning.position + $scope.page * module;
		switch($scope.sectionControll.selected){
			case 0:
				var room = $scope.rooms[index];
				//console.log(room, "i"+index);
				if(room.nombre_habitacion){
					return room.nombre_habitacion;
				}
					return "Salir";
			break;
			
			case 1:
				if($scope.roomSensors[index].nombre_sensor){
					return $scope.roomSensors[index].nombre_sensor;
				}
				else if($scope.roomSensors[index].type == "onlyReadSensors"){
					return "sensores";
				}
					return "Atrás";
			break;
			
			case 2:
				var state = $scope.sensorStates[$scope.getLinealPosition()];
				//console.log(state, "i"+index, $scope.sensorStates);
				//console.log($scope.scanning.position , $scope.page , module);
				if(angular.isNumber(state)){
					return "Valor "+$scope.sensorStates[$scope.scanning.position + $scope.page * module];
				}
				else if(angular.isObject(state)){
					if(state.type == "salir"){
						return "Atrás";
					}
				}
				
			break;
			
			case 3:
				switch($scope.analogic.scanning.section){
					case 0:
						if($scope.analogic.scanning.position == 0){
							return "Cambiar valor";
						}
						else if($scope.analogic.scanning.position == 1){
							return "Atrás";
						}
					break;
					
					case 1:
						if($scope.analogic.scanning.position == 0){
							return "Primer cuarto";
						}
						else if($scope.analogic.scanning.position == 1){
							return "Segundo cuarto";
						}
						else if($scope.analogic.scanning.position == 2){
							return "Tercer cuarto";
						}
						else if($scope.analogic.scanning.position == 3){
							return "Cuarto cuarto";
						}
					break;
					
					case 2:
						return $scope.analogic.val;
					break;
				}
				
			break;
			
			case 4:
				return "Atrás";
			break;
		}
	}
	
	$scope.getModule = function(){
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
		
		return module;
	}
	
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
		var nPages =  Math.ceil((items	) / ($scope.filas * $scope.cols));
		return nPages;
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
		$scope.sectionControll.selected = 3;
		$scope.analogic.sensor = sensor;
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
	
	$scope.clickNewAnalogicValue = function(newValue){
		setAnalogicSensor(newValue);
	}
	
	$scope.isCurrentSensorValue = function(value){
		if(value == $scope.selectedNStateSensor.Valor){
			return true;
		}
		else{
			return false;
		}
	}
	
	$scope.isCrom = function(){
		if($scope.config.ayudaCromatica == 0){
			return false;
		}
		else{
			return true;
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
	
	$scope.isAnalogicBackScanned = function(){
		if($scope.scanning.activated && $scope.analogic.scanning.section == 0 && $scope.analogic.scanning.position == 1){
			return true;
		}
		else{
			return false;
		}
	}
	
	$scope.isAnalogicRangeScanned = function(){
		if($scope.scanning.activated && $scope.analogic.scanning.section == 0 && $scope.analogic.scanning.position == 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	$scope.analogicQuarterScanned = function(){
		if($scope.scanning.activated && ($scope.analogic.scanning.section == 1 || $scope.analogic.scanning.section == 2) && $scope.analogic.scanning.position == 0){
			return 0;
		}
		else if($scope.scanning.activated && ($scope.analogic.scanning.section == 1 || $scope.analogic.scanning.section == 2) && $scope.analogic.scanning.position == 1){
			return 1;
		}
		else if($scope.scanning.activated && ($scope.analogic.scanning.section == 1 || $scope.analogic.scanning.section == 2) && $scope.analogic.scanning.position == 2){
			return 2;
		}
		else if($scope.scanning.activated && ($scope.analogic.scanning.section == 1 || $scope.analogic.scanning.section == 2) && $scope.analogic.scanning.position == 3){
			return 3;
		}
		else{
			return -1;
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
	
	$scope.mySpeak = function(msg){
		speakerService.speak(msg);
	}
		
	/**
	*	Funciones auxiliares.
	**/
		
	$scope.getButtonIndex = function(fila, col){
		return getUnidimensionalIndex(fila, col, $scope.cols, $scope.page, $scope.filas*$scope.cols)
	}
	
	$scope.sanitizeImgRoute = routeService.sanitizeImgRoute;
	
	$scope.range = range;
		
	$scope.debug = function(){
		console.log("Cargando homeController...");
		console.log($scope);
		//console.log($scope.rooms);
	}
	
	init();
	
	$scope.debug();
});