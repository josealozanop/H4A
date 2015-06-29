app.controller('homeController', function($scope, $attrs, $filter, $window, $http) {
	var init = function(){
		var jsonData = $attrs.userData;
		var rawData = angular.fromJson(window.atob(jsonData));
		$scope.rooms = rawData.rooms;
		$scope.config = rawData.config;
		$scope.layout = rawData.layout;
		
		$scope.filas = $scope.getFilas();
		$scope.cols = $scope.getCols();
		
		$scope.sections = ["rooms", "sensors", "sensor"];
		$scope.selectedSection = 0;
		$scope.needNavigation = needNavigation();
		$scope.position = "horizontal";
	}
	
	var needNavigation = function(){
		var nRooms = $scope.rooms.length;
		var cols = $scope.cols;
		var filas =  $scope.filas;
		
		var nSlots = parseInt(filas) * parseInt(cols);
		//console.log(nSlots, nRooms);
		if(nSlots < nRooms){
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
	
	var buttonsSize = function(){

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