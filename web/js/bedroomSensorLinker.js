app.controller('bedroomSensorLinker', ['$scope', '$http', function($scope,$http) {
	
	var requestParams = {
		params : {service : 'getMySensor'}
	};

	$http.get('./serviceController',requestParams).
		success(function(data, status, headers, config) {
			$scope.raw_data = data;
			for(i in $scope.raw_data) {
				var currentSensor = $scope.raw_data[i];
				console.log($scope.raw_data[i]);
				$scope.allSensors.push(new Sensor(currentSensor.codigo_sensor,currentSensor.nombre_sensor,currentSensor.senact_sensor,currentSensor.tipo_sensor, currentSensor.modelo_sensor,currentSensor.descripcion_sensor));
			}
		}).
		error(function(data, status, headers, config) {
			console.log("ERROR el servicio ");
		});
	
	function Sensor(code, name, senact, tipe, model, description) {
		this.code = code,
		this.name = name,
		this.senact = senact,
		this.tipe = tipe,
		this.model = model,
		this.description = description,
		this.selected = false,
		this.select = function() {
			if(this.selected) {
				this.selected = false;
			}
			else {
				this.selected = true;
			}
		}
	}
	
	$scope.allSensors = new Array();
	$scope.selectedSensors = new Array();
	
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
			$scope.selectedSensors.push(new Sensor(toPass[d].code,toPass[d].name,toPass[d].senact,toPass[d].tipe,toPass[d].model,toPass[d].description));
		}
	
	}
	
	$scope.unlinkSensors = function() {
		var toPass = new Array();
		var leftSensors = JSON.parse(JSON.stringify($scope.selectedSensors))
		var newIndex = 0;
		for(d in leftSensors) {
			if(leftSensors[d].selected){
				leftSensors[d].selected = false;
				toPass.push(leftSensors[d]);
				$scope.selectedSensors.splice(d-newIndex,1);
				newIndex++;
			}
		}
			for(d in toPass) {
			$scope.allSensors.push(new Sensor(toPass[d].code,toPass[d].name,toPass[d].senact,toPass[d].tipe,toPass[d].model,toPass[d].description));
		}
	}

}]);