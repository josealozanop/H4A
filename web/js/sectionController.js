var app = angular.module('home', []);

app.controller('sectionController', ['$scope', function($scope) {
	navBarMobile = {
		expand_login : false,
		error : false,
		click : function () {
			if(!this.expand_login) {
				this.expand_login = true
			}
		}
	}
}]);