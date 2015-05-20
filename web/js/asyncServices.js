app.service('asyncServices', ['$http', function($http) {
	console.log("asyncServices was loaded");
	
	this.ping = function () {
		console.log("pong");
		return "pong";
	}
	
	var Service = function(serviceName) {
		this.requestParams = {
			params : {
				service : serviceName,
				input : {}
			}
		}
		this.status = "not init";
		this.callback = function() {
			console.log("callback por defecto");
		};

	}
	
	Service.prototype.init = function(inputData) {
		this.status = "requesting";
		return this.callback(inputData);
	}
	
	this.getMyDevices = new Service('getMyDevices');
	this.getMyDevices.callback = function() {
		return $http.get('./serviceController',this.requestParams);
	}
	

	this.getMySensor = new Service('getMySensor');
	this.getMySensor.callback = function() {
		return $http.get('./serviceController',this.requestParams);
	}
	
	this.getMySensorBedroom = new Service('getMySensorBedroom');
	this.getMySensorBedroom.callback = function(inputData) {
		this.requestParams.params.input = inputData;
		return $http.get('./serviceController',this.requestParams);
	}
	
	this.getMyDisp = new Service('getMyDisp');
	this.getMyDisp.callback = function(inputData) {
		this.requestParams.params.input = inputData;
		return $http.get('./serviceController',this.requestParams);
	}
	
	this.getAllRooms = new Service('getAllRooms');
	this.getAllRooms.callback = function(inputData) {
		this.requestParams.params.input = inputData;
		return $http.get('./serviceController',this.requestParams);
	}
	
	this.getAllSensors = new Service('getAllSensors');
	this.getAllSensors.callback = function(inputData) {
		this.requestParams.params.input = inputData;
		return $http.get('./serviceController',this.requestParams);
	}
	
	this.getLinkSensors = new Service('getLinkSensors');
	this.getLinkSensors.callback = function(inputData) {
		this.requestParams.params.input = inputData;
		return $http.get('./serviceController',this.requestParams);
	}
	
	this.echo = new Service('echo');
	this.echo.callback = function(inputData) {
		this.requestParams.params.input = inputData;
		return $http.get('./serviceController',this.requestParams);
	}
	

	this.insertDevice = new Service('insertDevice');
	this.insertDevice.callback = function(inputData) {
		this.requestParams.params.input = inputData;
		return $http.get('./serviceController',this.requestParams);
	}
	
	
	this.linkDeviceTutor = new Service('linkDeviceTutor');
	this.linkDeviceTutor.callback = function(inputData) {
		this.requestParams.params.input = inputData;
		return $http.get('./serviceController',this.requestParams);
	}
	
	this.linkDeviceUser = new Service('linkDeviceUser');
	this.linkDeviceUser.callback = function(inputData) {
		this.requestParams.params.input = inputData;
		return $http.get('./serviceController',this.requestParams);
	}
	
	
	
	/*this.getMyDevices = new Service(
		function() {
			var requestParams = {
			params : {service : 'getMyDevices'}
		};
		
		return $http.get('./serviceController',requestParams);
		}
	);*/
	
	/*this.getMyDevices = function() {
		var requestParams = {
			params : {service : 'getMyDevices'}
		};
		
		return $http.get('./serviceController',requestParams);
	}*/
	

	return this;
	
}]);