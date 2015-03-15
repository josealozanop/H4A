var app = angular.module('home', []);

app.controller('sectionController', ['$scope', function($scope) {

	$scope.navBarMobile = {

		expand_login : false,
		error : false, //error a la hora de hacer login
		expand_menu : false,
		
		click_login : function () {
			if(!this.expand_login) {
				this.expand_login = true
			}
			else {
				this.expand_login = false
			}
		},
		
		click_menu : function () {
			if(!this.expand_menu) {
				this.expand_menu = true
			}
			else {
				this.expand_menu = false
			}
		}
	}
	
	$scope.newTutor = {
		name : "",
		mail : "",
	}
	
	$scope.ping = function(){
		console.log($scope.newTutor);
	}
	
	$scope.serviceSwitcher = function (service, data) {
		return "serviceController?service=addDevice&name=hola&MAC=4A-DD";
	}
}]);