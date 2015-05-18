app.controller('configUser', ['$scope', 'asyncServices', '$attrs','$filter', function($scope,asyncServices,$attrs,$filter) {
	
	$scope.init = function(){
		$scope.idUsuario = $attrs.idUsuario;
		var devicesData = angular.fromJson($attrs.devicesData);
		$scope.devices = [];
		for(i in devicesData){
			$scope.devices.push(angular.fromJson(devicesData[i]));
		}
	}
	
	$scope.sinfo = function(){
		console.log($scope)
	}
	
	$scope.init();
	$scope.sinfo();
}]);