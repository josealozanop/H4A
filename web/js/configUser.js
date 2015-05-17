app.controller('configUser', ['$scope', 'asyncServices', function($scope,asyncServices,$attrs) {
	
	var services = asyncServices;
	
	var id_usuario= angular.element("#id_us")[0].valueAsNumber;
	
	console.log(angular.element("#id_us"));
	$scope.queryInsert = {
		id_us : id_usuario
	}
		
	services.getMyDisp.init(JSON.stringify($scope.queryInsert))
		.success(function(data, status, headers, config) {
			$scope.raw_data = data;
			for(i in $scope.raw_data) {
				var currentDisp = $scope.raw_data[i];
				$scope.allDisp.push(new Disp(currentDisp.id_dispositivo,currentDisp.nombre_dispositivo));
			}
		})
		.error(function(data, status, headers, config) {
			console.log("ERROR el servicio ");
		});
		
	function Disp(id, nombre) {
		this.id = id,
		this.nombre = nombre
	}
	
	$scope.allDisp = new Array();	
	/*
	var dataToSend = {
		idSensorVin : new Array(),
		idSensorDes : new Array()
	}
	$scope.formatedData = JSON.stringify(dataToSend);
	*//*
	$scope.linkSensors = function() {
		var toPass = new Array();
		var rightSensors = JSON.parse(JSON.stringify($scope.allSensors));
		var newIndex = 0;
		for(d in rightSensors) {
			if(rightSensors[d].selected){
				rightSensors[d].selected = false;
				toPass.push(rightSensors[d]);
				$scope.allSensors.splice(d-newIndex,1);
				newIndex++;
			}
		}
		for(d in toPass) {
			$scope.selectedSensors.push(new Sensor(toPass[d].id,toPass[d].code,toPass[d].name,toPass[d].senact,toPass[d].tipe,toPass[d].model,toPass[d].description));
		}
	}*/	
}]);