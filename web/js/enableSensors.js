app.controller('enableSensors', ['$scope', 'asyncServices', '$attrs','$filter', function($scope,asyncServices,$attrs,$filter) {
	$scope.current_idUsuario = $attrs.idUsuario;
	$scope.allRooms = [];
	$scope.allSensors = [];
	
	$scope.roomComparator = function(actual, expected){
		if (!expected) {
			return true;
		}
		return angular.equals(expected, actual);
	}
	
	$scope.sortPredicate = "";
	
	$scope.sinfo = {
		a : "not loaded",
		s : function() {
			/*console.log("enableSensors is loaded");
			console.log($scope.current_idUsuario);
			console.log($scope.allRooms);
			console.log($scope.allSensors);
			console.log($scope.selectedRoom);*/
			$scope.getDataToSend();
			console.log($scope.dataToSendObject);
		}
	}
	
	$scope.init = function(){	
		
		asyncServices.getAllSensors.init()
		.success(function(data, status, headers, config) {
			$scope.allSensors = data;
			$scope.allSensors = be_addAttr($scope.allSensors,"enabled",false);
			asyncServices.getAllRooms.init()
			.success(function(data, status, headers, config) {
				$scope.allRooms = data;
				$scope.indexedRooms = be_indexer($scope.allRooms,"id_habitacion");
				$scope.indexedRoomsByName = be_indexer($scope.allRooms,"nombre_habitacion");
				$scope.roomsNames = be_getAttrVals($scope.allRooms,"nombre_habitacion");
				$scope.roomsNames.unshift("Todas");
				$scope.selectedRoom = $scope.roomsNames[0]; 
				//console.log($scope.indexedRooms);
				//console.log($scope.roomsNames);
			})
			.error(function(data, status, headers, config) {
				console.log("ERROR el servicio: ");
			});
		})
		.error(function(data, status, headers, config) {
			console.log("ERROR el servicio: ");
		});
	}
	
	$scope.dataToSendObject = {
		user_id : $scope.current_idUsuario,
		enabledSensors : $scope.allSensors
	}
	
	$scope.getDataToSend = function(){
		$scope.dataToSendObject.enabledSensors = $scope.allSensors;
		$scope.dataToSendObject.enabledSensors = $filter('filter')($scope.dataToSendObject.enabledSensors, {enabled : true}, true);
		$scope.dataToSend = angular.toJson($scope.dataToSendObject);
	}
	
	$scope.init();
}]);