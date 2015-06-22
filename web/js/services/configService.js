app.service('configService', ['$http', function($http) {

	this.configUser = function(data){
		$http.post("/H4A/src/Controllers/configController.php", data);
	}		
	
	return this;
	
}]);