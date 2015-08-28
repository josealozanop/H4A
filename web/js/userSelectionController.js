app.controller('userSelectionController', function($scope, $attrs, $filter, $window, $http, $timeout, $rootScope, screenService) {
	var init = function(){
		var jsonData = $attrs.userData;
		var rawData = angular.fromJson(window.atob(jsonData));
		$scope.mac = rawData.mac;
		$scope.users = rawData.users;
		$scope.users.push({
			type : "salir"
		});

		$scope.assets = rawData.assets;
		
		var defaultConfig = {
			layout : {
				vertical :{
					filas : 3,
					cols : 1
				},
				horizontal : {
					filas : 2,
					cols : 2
				}
			},
			crom : "false",
			scanning : {
				activated : false,
				position : 0
			}			
		}
		
		$scope.scanning = {
			activated : false,
			miliseconds : 2000,
			position : 0,
			leftArrow : false,
			rightArrow : false
		}
		
		$scope.config = defaultConfig;
		$scope.screen = {
			position : $scope.getInitialLayout()
		};
		
		$scope.filas = $scope.getFilas();
		$scope.cols = $scope.getCols();
		
		$scope.page = 0;
		$scope.nPages = $scope.getNpages();
		$scope.needNavigation = $scope.isNeededNavigation();
		
		$scope.buttonSize = {
			width : $scope.getButtonWidth(),
			height : $scope.getButtonHeight()
		}
		
		$scope.offline = false;
	}
	
	$scope.isScanning = function(){
		return $scope.config.scanning.activated;
	}
	
	$scope.isCrom = function(){
		return $scope.config.crom;
	}
	
	/**
		Getters
	**/
	$scope.getNpages = function(){
		return Math.ceil($scope.users.length/$scope.getLayoutCapacity());
	}
	
	$scope.getButtonHeight = function(){
		return (100/$scope.getFilas());
	}
	
	$scope.getButtonWidth = function(){
		return 100/$scope.getCols();
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
	
	$scope.getScreenPosition = function(){
		return $scope.screen.position;
	}
	
	$scope.getFilas = function(){
		var filas = $scope.config.layout.horizontal.filas;
		if($scope.screen.position == "vertical"){
			filas = $scope.config.layout.vertical.filas;
		}
		return filas;
	}
	
	$scope.getCols = function(){
		var cols = $scope.config.layout.horizontal.cols;
		if($scope.screen.position == "vertical"){
			cols = $scope.config.layout.vertical.cols;
		}
		return cols; 
	}
	
	$scope.getLayoutCapacity = function(){
		return $scope.getFilas() * $scope.getCols();
	}
	
	$scope.getLimitedText = function(text){
		if(text){
			var max = text.length;
			var screen = screenService.getScreenSize();
			var shortName = false;
			
			switch(screen){
				case "xs":
					if(max > 11){
						max = 9;
						shortName = true;
					}	
				break;
				
				case "sm" :
					if(max > 14){
						max = 12;
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
	
	/**
		Checkers
	**/
	$scope.isNeededNavigation = function(){
		if($scope.users.length > $scope.getLayoutCapacity()){
			return true;
		}
		else{
			return false;
		}
	};
	
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
	
	$scope.isCurrentScanned = function(index){
		//console.log(index, $scope.scanning.position)
		if($scope.scanning.activated && index == $scope.scanning.position){
			return true;
		}
		else{
			return false;
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
	
	/**
		Listeners
	**/
	$rootScope.$on("screenChange", function(context, data){
		$scope.screen.position = data.position;
		//console.log($scope.screen.position);
		

		$scope.filas = $scope.getFilas();
		$scope.cols = $scope.getCols();		
		$scope.config.scanning.position = 0;
		$scope.page = 0;
		$scope.nPages = $scope.getNpages();
		
		$scope.buttonSize = {
			width : $scope.getButtonWidth(),
			height : $scope.getButtonHeight()
		}
		$scope.$apply();
	})
	
	/**
		Clicks
	**/
	$scope.clickNext = function(){
		if($scope.page+1 < $scope.nPages){
			$scope.scanning.position = 0;
			$scope.page += 1;
		}
		console.log($scope.page);
	}
	
	$scope.clickPrevious = function(){
		if($scope.page > 0){
			$scope.scanning.position = 0;
			$scope.page -= 1;
		}	
		console.log($scope.page);
	}
	
	$scope.clickUser = function(user){
		if(user.type == "salir"){
			//lógica para salir al index
		}
		var path = $scope.getPath(user);
		//var path = "./insertPass";
		
		$window.location.href = path;
	}
	
	/**
		Auxiliares
	**/
	$scope.range = range;
	
	$scope.getButtonIndex = function(fila, col){
		return getUnidimensionalIndex(fila, col, $scope.cols, $scope.page, $scope.filas*$scope.cols)
	}
	
	$scope.debug = function(){
		console.log("Cargando userSelection...");
		console.log($scope);
	}
	
	$scope.getPath = function(user){
		var base = "./insertPass?sid=";
		var id = user.id_usuario;
		id = window.btoa(id);
		return base+id;
	}
	
	init();
	$scope.debug();
});