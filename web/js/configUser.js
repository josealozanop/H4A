app.controller('configUser', ['$scope', 'asyncServices', '$attrs','$filter', function($scope,asyncServices,$attrs,$filter) {
	var ColPrin;
	var ColSec;
	$scope.init = function(){
		ColPrin="";
		ColSec="";
		Gama1 = false;
		Gama2 = false;
		DifCrom = false;
		$scope.idUsuario = $attrs.idUsuario;
		var devicesData = angular.fromJson($attrs.devicesData);
		var devicesNames = angular.fromJson(window.atob($attrs.names));
		$scope.devices = [];
		console.log(DifCrom);
		for(i in devicesData){
			var newDevice = angular.fromJson(devicesData[i])[0];
			newDevice.name = devicesNames[i];
			newDevice.config = {
				layout :{
					horizontal : [3,3],
					vertical : [4,2],
					verticalAllowed : false
				}
			}
			$scope.devices.push(newDevice); //En esta variable ya quedan todos los datos del dispositivo: id, mac, nombre, usuario por defecto
		}
		$scope.selectedDevice = 0;
		$scope.selectedView = "horizontal";
	}
	
	$scope.isSelected = function(index){
		if(index==$scope.selectedDevice){
			return true;
		}
		else{
			return false;
		}
	}
	
	$scope.isAllowed = function(){
		var allowed = $scope.devices[$scope.selectedDevice].config.layout.verticalAllowed;
		return allowed;
	}
	$scope.isDifCrom = function(){
		return DifCrom;		
	}
	$scope.isGama2 = function(){
		return Gama2;		
	}
	$scope.isGama1 = function(){
		return Gama1;		
	}
	$scope.range = be_range;
	
	$scope.setVerticalAllowed = function(){
		var allowed = $scope.devices[$scope.selectedDevice].config.layout.verticalAllowed;
		console.log(allowed)
		if(allowed){
			$scope.devices[$scope.selectedDevice].config.layout.verticalAllowed = false;
		}
		else{
			$scope.devices[$scope.selectedDevice].config.layout.verticalAllowed = true;
		}
	}
	$scope.setDifCrom = function(){
		console.log(DifCrom)
		if(DifCrom){
			DifCrom = false;			
			ColPrin="";
			ColSec="";
		}
		else{
			DifCrom = true;
			ColPrin="blue";
			ColSec="orange";
		}
	}
	$scope.setSelectedDevice = function(index){
		$scope.selectedDevice = index;
		$scope.selectedView = "horizontal";
	}
	
	$scope.changeSelectedView = function(view){
		$scope.selectedView = view;
	}
	
	$scope.isHorizontal = function(){
		if($scope.selectedView == "horizontal"){
			return true;
		}
		else{
			return false;
		}
	}
	
	$scope.getRows = function(){
		var deviceLayout = $scope.devices[$scope.selectedDevice].config.layout;
		if($scope.isHorizontal()){
			return deviceLayout.horizontal[0];
		}
		else{
			return deviceLayout.vertical[0];
		}
	}
	
	$scope.getCols = function(){
		var deviceLayout = $scope.devices[$scope.selectedDevice].config.layout;
		if($scope.isHorizontal()){
			return deviceLayout.horizontal[1];
		}
		else{
			return deviceLayout.vertical[1];
		}
	}
	
	$scope.getElementNumber = function(i,j){
		return i*$scope.getCols()+j;
	}
	
	$scope.getElementHeight = function(){
		var baseHeight = 0;
		if($scope.isHorizontal()){
			baseHeight = 300;
		}
		else{
			baseHeight = 530;
		}
		
		var elemHeight = baseHeight / $scope.getRows();
		
		return elemHeight+"px";
	}
	
	$scope.getElementWidth = function(){
		var factor = 100/$scope.getCols();
		//factor -= 2;
		return factor+"%";
	}
	$scope.btnPricolor = function(index){
		$scope.CPRed= "btn btn-danger";
		$scope.CPOr= "btn btn-warning";		
		$scope.CPYe= "btn btn-default";
		$scope.CPBlu= "btn btn-primary";
		$scope.CPPur= "btn btn-info";
		$scope.CSRed= "btn btn-danger";
		$scope.CSOr= "btn btn-warning";		
		$scope.CSYe= "btn btn-default";
		$scope.CSBlu= "btn btn-primary";
		$scope.CSPur= "btn btn-info";
		switch (index){
			case "red":
				$scope.CPRed= "btn btn-danger btn-lg active";
				Gama2=true;
				Gama1=false;
			break;
			case "orange":
				$scope.CPOr= "btn btn-warning btn-lg active";
				Gama2=true;
				Gama1=false;
			break;
			case "yellow":
				$scope.CPYe= "btn btn-default btn-lg active";
				Gama2=true;
				Gama1=false;
			break;
			case "blue":
				$scope.CPBlu= "btn btn-primary btn-lg active";
				Gama1=true;
				Gama2=false;
			break;
			case "purple":
				$scope.CPPur= "btn btn-info btn-lg active";
				Gama1=true;
				Gama2=false;
			break;
			}
		ColPrin=index;
		ColSec="";
	}
	$scope.btnSecolor = function(index){
		$scope.CSRed= "btn btn-danger";
		$scope.CSOr= "btn btn-warning";		
		$scope.CSYe= "btn btn-default";
		$scope.CSBlu= "btn btn-primary";
		$scope.CSPur= "btn btn-info";
		switch (index){
			case "red":
				$scope.CSRed= "btn btn-danger btn-lg active";
			break;
			case "orange":
				$scope.CSOr= "btn btn-warning btn-lg active";
			break;
			case "yellow":
				$scope.CSYe= "btn btn-default btn-lg active";
			break;
			case "blue":
				$scope.CSBlu= "btn btn-primary btn-lg active";
			break;
			case "purple":
				$scope.CSPur= "btn btn-info btn-lg active";
			break;
			}
		ColSec=index;
	}
	$scope.sinfo = function(){
		console.log($scope)
	}
	
	$scope.init();
	$scope.sinfo();
}]);