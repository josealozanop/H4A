app.controller('userAssetsController', function($scope, asyncServices, $attrs, $filter, $window, configService, $http) {
	
	$scope.init = function(){
		
		$scope.debug == true;
		$scope.setImages = false;
		$scope.reqStatus = {
			global : 2,
			rooms : 0,
			sensors : 0
		};
		$scope.rooms = [];
		$scope.sensors = [];
		$scope.selectedRoom = {room : null};
		$scope.selectedSensor = {sensor : null};
		$scope.idUsuario = $attrs.idUsuario;	
		
		$scope.uploadFile = function(event){
			$scope.selectedRoom.room.imgFile = event.target.files;
		};
		
		$scope.uploadFileSensor = function(event){
			$scope.selectedSensor.sensor.imgFile = event.target.files;
		};
		
		$scope.uploadFileSensorOn = function(event){
			$scope.selectedSensor.sensor.imgFileOn = event.target.files;
		};
		
		$scope.uploadFileSensorOff = function(event){
			$scope.selectedSensor.sensor.imgFileOff = event.target.files;
		};
		
		//Pedimos las habitaciones
		dataToSend = window.btoa(angular.toJson({
			action : "getRooms"
		}));
		
		$scope.reqStatus.rooms = 2;
		$http.get("./getRooms").
		then(function(data, status, headers, config) {
			var requestData = data.data;
			var requestStatus = requestData.status;
			//console.log(data);
			if(requestStatus == 1){
				$scope.rooms = angular.fromJson(requestData.data).rooms;
				for(i in $scope.rooms){
					//var item = $scope.rooms[i];
					//item["img"] = "/H4A/web/images/svg/home.svg";
					$scope.rooms[i].imgFile = new FileReader();
				}
				$scope.selectedRoom.room = $scope.rooms[0];
				$scope.reqStatus.rooms = 1;
			}
			else{
				$scope.reqStatus.rooms = -1;
				console.log("Error al realizar getRooms", data, status, config)
			}
		})
		
		//Pedimos los sensores ligados a un usuario
		dataToSend = window.btoa(angular.toJson({
			usersIds : [$scope.idUsuario]
		}));
		$scope.reqStatus.sensors = 2;
		$http.get("./getSensorsByUsers?data="+dataToSend).
		then(function(data, status, headers, config) {
			var requestData = data.data;
			var requestStatus = requestData.status;
			//console.log(data);
			if(requestStatus == 1){
				$scope.sensors = angular.fromJson(requestData.data).sensors;
				for(i in $scope.sensors){
					$scope.sensors[i].imgFile = new FileReader();
				}
				$scope.selectedSensor.sensor = $scope.sensors[0];
				$scope.reqStatus.sensors = 1;
			}
			else{
				$scope.reqStatus.sensors = -1;
				console.log("Error al realizar getSensors", data, status, config)
			}
		})
	}
	
	var setGlobalRequestStatus = function(){
		if($scope.reqStatus.sensors == 1 && $scope.reqStatus.rooms == 1){
			$scope.reqStatus.global = 1;
		}
		else if($scope.reqStatus.sensors == -1 || $scope.reqStatus.rooms == -1){
			$scope.reqStatus.global = -1;
		}
		else{
			$scope.reqStatus.global = 2;
		}
	}
	
	
	$scope.$watch("reqStatus.sensors", function(){
		setGlobalRequestStatus();
	})
	
	$scope.$watch("reqStatus.rooms", function(){
		setGlobalRequestStatus();
	})
	
	$scope.endConfig = function(){
		$window.location.href = './tutor?status=1';
	}
	
	$scope.updateAssets = function(){
		$window.location.href = '/H4A/web/updateAssets';
	}
	
	$scope.getSensorInputName = function(sensor, type){
		if(type==0){
			return "sensor"+sensor.id_sen+"OFF";
		}
		else if(type==1){
			return "sensor"+sensor.id_sen+"ON";
		}
		else if(type==-1){
			return "sensor"+sensor.id_sen;
		}
		
	}
	
	$scope.getRoomsData = function(){
		return angular.toJson($scope.rooms);
	}
	
	$scope.getSensorsData = function(){
		return angular.toJson($scope.sensors);
	}
	
	$scope.showScope = function(){
		console.log($scope);
		//console.log($scope.selectedRoom.room.imgFile[0].readAsDataURL());
		console.log($scope.selectedRoom.room.imgFile[0]);
	}
		
	$scope.init();
	console.log($scope);
});