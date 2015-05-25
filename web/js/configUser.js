app.controller('configUser', ['$scope', 'asyncServices', '$attrs','$filter', function($scope,asyncServices,$attrs,$filter) {
	
	$scope.init = function(){
		$scope.idUsuario = $attrs.idUsuario;
		var devicesData = angular.fromJson($attrs.devicesData);
		var devicesNames = angular.fromJson(window.atob($attrs.names));
		$scope.devices = [];
		for(i in devicesData){
			var newDevice = angular.fromJson(devicesData[i])[0];
			newDevice.name = devicesNames[i];
			newDevice.config = {
				layout :{
					horizontal : [3,3],
					vertical : [4,2],
					verticalAllowed : false
				}
			}
			$scope.devices.push(newDevice); //En esta variable ya quedan todos los datos del dispositivo: id, mac, nombre, usuario por defecto
		}
		$scope.selectedDevice = 0;
		$scope.selectedView = "horizontal";
	}
	
	$scope.isSelected = function(index){
		if(index==$scope.selectedDevice){
			return true;
		}
		else{
			return false;
		}
	}
	
	$scope.isAllowed = function(){
		var allowed = $scope.devices[$scope.selectedDevice].config.layout.verticalAllowed;
		return allowed;
	}
	
	$scope.range = be_range;
	
	$scope.setVerticalAllowed = function(){
		var allowed = $scope.devices[$scope.selectedDevice].config.layout.verticalAllowed;
		console.log(allowed)
		if(allowed){
			$scope.devices[$scope.selectedDevice].config.layout.verticalAllowed = false;
		}
		else{
			$scope.devices[$scope.selectedDevice].config.layout.verticalAllowed = true;
		}
	}
	
	$scope.setSelectedDevice = function(index){
		$scope.selectedDevice = index;
		$scope.selectedView = "horizontal";
	}
	
	$scope.changeSelectedView = function(view){
		$scope.selectedView = view;
	}
	
	$scope.isHorizontal = function(){
		if($scope.selectedView == "horizontal"){
			return true;
		}
		else{
			return false;
		}
	}
	
	$scope.getRows = function(){
		var deviceLayout = $scope.devices[$scope.selectedDevice].config.layout;
		if($scope.isHorizontal()){
			return deviceLayout.horizontal[0];
		}
		else{
			return deviceLayout.vertical[0];
		}
	}
	
	$scope.getCols = function(){
		var deviceLayout = $scope.devices[$scope.selectedDevice].config.layout;
		if($scope.isHorizontal()){
			return deviceLayout.horizontal[1];
		}
		else{
			return deviceLayout.vertical[1];
		}
	}
	
	$scope.getElementNumber = function(i,j){
		return i*$scope.getCols()+j;
	}
	
	$scope.getElementHeight = function(){
		var baseHeight = 0;
		if($scope.isHorizontal()){
			baseHeight = 300;
		}
		else{
			baseHeight = 530;
		}
		
		var elemHeight = baseHeight / $scope.getRows();
		
		return elemHeight+"px";
	}
	
	$scope.getElementWidth = function(){
		var factor = 100/$scope.getCols();
		//factor -= 2;
		return factor+"%";
	}
	
	$scope.sinfo = function(){
		console.log($scope)
	}
	
	$scope.init();
	$scope.sinfo();
}]);