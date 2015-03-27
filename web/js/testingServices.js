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
	
	var inputs = {
		insertDevice : {
			MAC : "borjedfaaasdasdsfa",
			uDefault : ""
		},
		linkDeviceTutor : {
			idDispositivo : "40",
			nombreDispositivo : "iphone"
		}
	}
	
		
	$scope.callService = function() {
		if(services[$scope.selectedService]){
			services[$scope.selectedService].init(JSON.stringify(inputs.insertDevice))
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
	
	$scope.error = function () {
		var requestParams = {
			params : {
				service : "error",
				input : {
					
				}
			}
		}
		$http.get('./serviceController',requestParams);
	}
	
	$scope.linkDeviceUser = function () {
		var requestParams = {
			params : {
				service : "linkDeviceUser",
				input : {
					idDispositivo : 57,
					idUsuario : 46
				}
			}
		}
		var serviceCall = $http.get('./serviceController',requestParams);
		
		serviceCall.success( function(data, status, headers, config) {
			console.log(data);
		});
		
		serviceCall.error(function (data,status, headers, config) {
			console.log("error en el servicio linkDeviceUser");
			console.log();
		});
			
	}
	
}]);