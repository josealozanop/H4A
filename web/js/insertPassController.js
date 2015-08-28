app.controller('insertPassController', function($scope, $attrs, $filter, $window, $http, $timeout, $rootScope, screenService) {
	var init = function(){
		
		$scope.requestValidation = 0;
		$scope.idUsuario = $attrs.idUsuario;
				
		$scope.pass = "";
		$scope.noValidPass = false;
				
		$scope.scanning = {
			activated : false,
			miliseconds : 2000,
			position : 0,
			leftArrow : false,
			rightArrow : false
		}
		
		$scope.screen = {
			position : $scope.getInitialLayout()
		};
		
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
		
	$scope.getInputText = function(){
		if($scope.noValidPass){
			var text = "Password Invalido"
		}
		else{
			var text = "Password:"
			if($scope.pass != ""){
				text = $scope.pass;
			}
		}
		
		return text;
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
	
	$scope.getPadButtonText = function(fila, col){
		var padTexts = [
			[7, 8, 9],
			[4, 5, 6],
			[1, 2, 3],
			["Borrar", 0, "Aceptar"],
		]
		
		return padTexts[fila][col];
	}
	

	/**
		Checkers
	**/
		
	$scope.isCurrentScanned = function(index){
		//console.log(index, $scope.scanning.position)
		if($scope.scanning.activated && index == $scope.scanning.position){
			return true;
		}
		else{
			return false;
		}
	}
	
	$scope.noPass = function(){
		if($scope.pass == ""){
			return true;
		}
		return false;	
	}
	/**
		Listeners
	**/
	$rootScope.$on("screenChange", function(context, data){
		$scope.screen.position = data.position;
		//console.log($scope.screen.position);

		$scope.scanning.position = 0;
			
		$scope.$apply();
	})
	
	/**
		Clicks
	**/
	$scope.clickButton = function(text){
		if(text == 'Aceptar'){
			tryLogin();
		}
		else if(text == 'Borrar'){
			if($scope.pass.length > 0){
				$scope.pass = $scope.pass.substring(0, $scope.pass.length-1);
			}
		}
		else{
			$scope.noValidPass = false;
			if($scope.pass.length < 20){
				$scope.pass += text;
			}
		}
	}
		
	/**
		Auxiliares
	**/
	var tryLogin = function(){
		var dataToSend = {
			userId : $scope.idUsuario,
			pass : $scope.pass
		}
		
		dataToSend = window.btoa(angular.toJson(dataToSend));
		
		$scope.requestValidation = 2;
		$http.get("./checkPassword?data="+dataToSend).
			then(function(data, status, headers, config) {
				var requestData = data.data;
				var requestStatus = requestData.status;
				
				if(requestStatus == 1){
					$scope.requestValidation = 1;
					//console.log(requestData.data);
					if(requestData.data){
						//$window.location.href = "./homeController";
					}
					else{
						$scope.requestValidation = -1;
						$scope.pass = "";
						$scope.noValidPass = true;
					}
				}
				else{
					$scope.requestValidation = -1;
					console.log("Error al realizar peticion checkPassword" + requestStatus)
				}
			});
	}
	
	$scope.range = range;
	
	$scope.getButtonIndex = function(fila, col){
		return getUnidimensionalIndex(fila, col, $scope.cols, $scope.page, $scope.filas*$scope.cols)
	}
	
	$scope.debug = function(){
		console.log("Cargando inserPassController...");
		console.log($scope);
	}
	

	init();
	$scope.debug();
});