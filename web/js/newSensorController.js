app.controller('newSensorController', function($scope) {
	var init = function(){
		$scope.valor = new Object();
		$scope.valor.tipoValor = 0;
		$scope.tipo = "Sensor";
		console.log("newSensorController cargado");
	}
	
	$scope.changeValue = function(){
		console.log("aaa");
	}
	
	$scope.$watch('valor.tipoValor', function(){
		console.log("watcher");
		console.log($scope.valor.tipoValor);
	})
	
	init();
});