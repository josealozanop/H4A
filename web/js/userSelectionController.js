app.controller('userSelectionController', function($scope, $attrs, $filter, $window, $http, $timeout) {
	var init = function(){
		var jsonData = $attrs.userData;
		var rawData = angular.fromJson(window.atob(jsonData));
		$scope.mac = rawData.mac;
		$scope.users = rawData.users;
	}
	
	$scope.debug = function(){
		console.log("Cargando userSelection...");
		console.log($scope);
	}
	
	$scope.getPath = function(user){
		var base = "./homeController?user=";
		var id = user.id_usuario;
		return base+id;
	}
	
	init();
	$scope.debug();
});