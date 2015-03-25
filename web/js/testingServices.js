app.controller('testingServices', ['$scope', '$http','asyncServices', function($scope,$http,asyncServices) {
	console.log("testinServices was loaded");
	
	var s = asyncServices;
	
	var services = {
		getMyDevices : s.getMyDevices,
		echo : s.echo,
		insertDevice : s.insertDevice,
		linkDeviceTutor : s.linkDeviceTutor
	}
	
	$scope.selectedService="";
	$scope.output = "Service not called";
	$scope.input = "";
	
	var input = {
		MAC : "borjedfaaasdasdsfa",
		uDefault : ""
	}
	
	var input2 = {
		idDispositivo : "40",
		nombreDispositivo : "iphone"
	}
	
	var input3 = {
		id_dispositivo : "14",
		nombre_dispositivo : "marta"
	}
	
	$scope.callService = function() {
		if(services[$scope.selectedService]){
			services[$scope.selectedService].init(JSON.stringify(input))
				.success(function(data, status, headers, config) {
					$scope.output = data;
					console.log(data);
				})
			.error(function(data, status, headers, config) {
				console.log("ERROR en el servicio " +  $scope.selectedService);
				$scope.output = "Error en el servicio" +  $scope.selectedService +" ---";
			});
		}
		else {
			console.log("servicio"+ $scope.selectedService +" no encontrado");
		}
	}
	
}]);