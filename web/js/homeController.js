app.controller('homeController', function($scope, $attrs, $filter, $window, $http, $timeout) {
	var init = function(){
		var jsonData = $attrs.userData;
		var rawData = angular.fromJson(window.atob(jsonData));
		$scope.rooms = rawData.rooms;
		$scope.config = rawData.config;
		$scope.layout = rawData.layout;
		$scope.sensors = rawData.sensors;
		
		$scope.filas = $scope.getFilas();
		$scope.cols = $scope.getCols();
		
		$scope.sections = ["rooms", "sensors", "sensor"];
		$scope.selectedSection = 0;
		$scope.page = 0;
		$scope.roomSelected = null;
		$scope.nPages = $scope.getNpages();
		$scope.needNavigation = needNavigation($scope.rooms.length);
		$scope.position = "horizontal";
		
		$scope.scanning = {
			activated : false,
			position : 0
		}
		
		$scope.buttonSize = {
			width : $scope.getButtonWidth(),
			height : $scope.getButtonHeight()
		}
		
		if($scope.scanning.activated){
			$scope.tick();
		}
		
	}
	
	$scope.tick = function() {
        $timeout($scope.tick, 1000); 
		$scope.scanning.position = ($scope.scanning.position + 1) % 9;
		//console.log($scope.scanning.position)
    }
	
	var needNavigation = function(items){
		
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
	
	$scope.isCurrentScanned = function(index){
		//console.log(index, $scope.scanning.position)
		if($scope.scanning.activated && index == $scope.scanning.position){
			return true;
		}
		else{
			return false;
		}
	}
	
	$scope.getNpages = function(){
		return Math.ceil($scope.rooms.length / ($scope.filas * $scope.cols));
	}
	
	$scope.getButtonHeight = function(){
		var margin = [3, 3, 2, 1.8];
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
		//console.log($scope.page);
	}
	
	$scope.clickPrevious = function(){
		if($scope.page > 0){
			$scope.scanning.position = 0;
			$scope.page -= 1;
		}
	}
	
	$scope.clickRoom = function(room){
		$scope.selectedRoom = room;
		$scope.selectedSection = 1;
	}
	
	$scope.showButton = function(index){
		//console.log(index,  $scope.rooms.length)
		if(index < $scope.rooms.length){
			return 1;
		}
		else {
			return 0;
		}
	}
	
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