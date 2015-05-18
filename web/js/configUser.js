app.controller('configUser', ['$scope', 'asyncServices', '$attrs','$filter', function($scope,asyncServices,$attrs,$filter) {
	
	$scope.init = function(){
		$scope.idUsuario = $attrs.idUsuario;
		var devicesData = angular.fromJson($attrs.devicesData);
		var devicesNames = angular.fromJson(window.atob($attrs.names));
		$scope.devices = [];
		for(i in devicesData){
			var newDevice = angular.fromJson(devicesData[i])[0];
			newDevice.name = devicesNames[i];
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
	
	$scope.setSelectedDevice = function(index){
		$scope.selectedDevice = index;
	}
	
	$scope.sinfo = function(){
		console.log($scope)
	}
	
	$scope.init();
	$scope.sinfo();
}]);