app.controller('enableSensors', ['$scope', 'asyncServices', '$attrs','$filter', function($scope,asyncServices,$attrs,$filter) {
	$scope.requests = {}
	$scope.requests.sensorsData = "requesting"
	$scope.nSensors = 0
	$scope.currentPage = 1
	$scope.itemsPerPage = 5
	
	$scope.current_idUsuario = $attrs.idUsuario;
	$scope.allRooms = [];
	$scope.allSensors = [];
	
	$scope.paginationFilter = function(value, index) {
		var limits = $scope.getLimits();
		var inferiorLimit = limits[0]
		var superiorLimit = limits[1]
		
		if(index >= inferiorLimit && index < superiorLimit){
			return true
		}
		else{
			return false
		}
	};
	
	$scope.getLimits = function(){
		var inferiorLimit = ($scope.currentPage-1)*$scope.itemsPerPage;
		var superiorLimit = inferiorLimit+$scope.itemsPerPage;
		
		return [inferiorLimit, superiorLimit]
	}
	
	$scope.pageChange = function(){
		//console.log($scope.currentPage);
		var limits = $scope.getLimits();
		var inferiorLimit = limits[0]
		var superiorLimit = limits[1]
		console.log(inferiorLimit, superiorLimit, $scope.currentPage)
	}
	
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
	
	$scope.showPaginator = function(){
		if($scope.nSensors>0){
			return true
		}
		else{
			return false
		}
	}
	
	$scope.init = function(){	
		
		
		asyncServices.getAllSensors.init()
		.success(function(data, status, headers, config) {
			$scope.allSensors = data;
			$scope.allSensors = be_addAttr($scope.allSensors,"enabled",false);
			asyncServices.getAllRooms.init()
			.success(function(data, status, headers, config) {
				$scope.requests.sensorsData = "done"
				$scope.allRooms = data;
				$scope.indexedRooms = be_indexer($scope.allRooms,"id_habitacion");
				$scope.indexedRoomsByName = be_indexer($scope.allRooms,"nombre_habitacion");
				$scope.roomsNames = be_getAttrVals($scope.allRooms,"nombre_habitacion");
				$scope.roomsNames.unshift("Todas");
				$scope.selectedRoom = $scope.roomsNames[0]; 
				$scope.nSensors = $scope.allSensors.length;
				console.log("cargado")
				//console.log($scope.indexedRooms);
				//console.log($scope.roomsNames);
			})
			.error(function(data, status, headers, config) {
				console.log("ERROR el servicio: ");
				$scope.requests.sensorsData = "error"
			});
		})
		.error(function(data, status, headers, config) {
			console.log("ERROR el servicio: ");
			$scope.requests.sensorsData = "error"
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