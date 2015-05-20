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
					vertical : [2,4],
					verticalAllowed : false
				}
			}
			$scope.devices.push(newDevice); //En esta variable ya quedan todos los datos del dispositivo: id, mac, nombre, usuario por defecto
		}
		$scope.selectedDevice = 0;
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
	}
	
	$scope.sinfo = function(){
		console.log($scope)
	}
	
	$scope.init();
	$scope.sinfo();
}]);