app.controller('smartSearch', ['$scope', function($scope) {

	$scope.selectedUser = "";

	$scope.smartSearch = {
		touched : false,
		click : function() {
			
			if(!this.touched) {
				this.touched = true;
				
			}
			
		}
	}
	
	$scope.onClick = function(){
		console.log($scope.selectedUser)
	}
	
	$scope.$watch('smartSearch.touched', function(newValue, oldValue) {
		if(newValue) {
			connect_DB('getMyUsers').success(
				function(out){
					var myUsers = JSON.parse(out);

					var names = new Array();
					for (i in myUsers){
						names.push(myUsers[i].nombre_usuario);
					}
					
					for (i in names){
						$('#datalist-navbar-searchList').append("<option value='"+names[i]+"'></option>");
					}
				}
			);
		}
	});
}]);