app.controller('homeController', function($scope, $attrs, $filter, $window, $http, $timeout, $rootScope) {

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
		
		$scope.filas = $scope.getFilas();
		$scope.cols = $scope.getCols();
		
		$scope.sectionControll = {
			selected : 0,
			names : ["rooms", "sensors", "sensor"]
		}
		
		$scope.page = 0;
		$scope.roomSelected = null;
		$scope.nPages = $scope.getNpages($scope.rooms.length);
		$scope.needNavigation = $scope.getNeedNavigation($scope.rooms.length);
		$scope.position = "horizontal";
		
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
	
	$scope.tick = function() {
		
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
		//console.log($scope.scanning.position);
		$timeout($scope.tick, $scope.scanning.miliseconds); 
    }
	
	$scope.clickOnScanning = function(){
				
		if($scope.scanning.rightArrow){
			$scope.clickNext();
			$scope.scanning.rightArrow = false;
		}
		else if($scope.scanning.leftArrow){
			$scope.clickPrevious();
			$scope.scanning.leftArrow = false;
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
		if($scope.sectionControll.selected == 1){
			$scope.roomSensors = $scope.sensors.filter(function(sensor){
				//console.log(sensor);
				if(sensor.id_habitacion == $scope.selectedRoom.id_habitacion){
					return sensor;
				}
			});
			
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
					console.log("Error al obtener valor de los sensores")
				}
			});
			
			$scope.nPages = $scope.getNpages($scope.roomSensors.length);
			$scope.needNavigation = $scope.getNeedNavigation($scope.roomSensors.length);
			
			if($scope.scanning.activated){
				$scope.scanning.position = 0;
			}
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
		$scope.$apply();
	})
	
	/**
	* Getters
	**/
	
	$scope.getNeedNavigation = function(items){
		
		var cols = $scope.cols;
		var filas =  $scope.filas;
		
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
			filas = $scope.layout.filas_horizontal;
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
		return Math.ceil((items + 1) / ($scope.filas * $scope.cols));
	}
	
	$scope.getButtonHeight = function(){
		var margin = [3, 3, 2, 1.8, 1.5];
		var index = $scope.filas;
		if($scope.filas >= margin.length){
			index = margin.length-1;
		}
		return (100/$scope.filas)-margin[index];
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
			else{
				var newValue = 0;
				if(sensor.Valor == 0){
					newValue = 1;
				}
				
				dataToSend = window.btoa(angular.toJson({
					action : "setSensor",
					id : sensor.id_sen,
					value : newValue
				}));
				
				$http.post("/H4A/src/Controllers/asyncSensorController.php", dataToSend).
				then(function(data, status, headers, config) {
					var requestData = data.data;
					var requestStatus = requestData.status;
					
					if(requestStatus == 1){
						sensor.Valor = newValue;
					}
					else{
						console.log("Error al modificar el valor del sensor")
					}
				});
			}
	}	
	
	$scope.backToRooms = function(){
		$scope.sectionControll.selected = 0;
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