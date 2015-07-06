app.controller('roomController', function($scope, $attrs, $filter, $window, $http, $timeout) {
	var init = function(){
		$scope.roomSensors = $scope.sensors.filter(function(sensor){
			//console.log(sensor);
			if(sensor.id_habitacion == $scope.selectedRoom.id_habitacion){
				return sensor;
			}
		})
	}

	
	
	$scope.debug = function(){
		console.log("Cargando roomController...");
		console.log($scope.selectedRoom);
		console.log($scope.roomSensors);
		//console.log($scope.layout);
		
	}
	
	init();
	$scope.debug();
});