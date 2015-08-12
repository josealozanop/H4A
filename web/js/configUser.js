app.controller('configUser', function($scope, asyncServices, $attrs, $filter, $window, configService, $http) {
	
	$scope.init = function(){
		//console.log(configService.a);
		$scope.colorMap = {
			red : "#c12e2a",
			orange : "#eb9316",
			yellow : "#f7fe2e",
			blue : "#265a88",
			purple : "#cc2efa"
		};
		
		$scope.colPrin= "#265a88";
		$scope.colSec= "#eb9316";
		$scope.contrast = 1;
		$scope.fontSize = 12;
		$scope.reconocimientoVoz = 0;
		$scope.respuestaPorVoz = 0;
		$scope.vibracion = 0;
		Gama1 = false;
		Gama2 = false;
		$scope.difCrom = false;
		$scope.sistemaBarrido = 0;
		$scope.tiempoBarrido = 4;
		MostcolSec=false;
		$scope.requestStatus = 0;
		
		$scope.idUsuario = $attrs.idUsuario;
		var devicesData = angular.fromJson($attrs.devicesData);
		var devicesNames = angular.fromJson(window.atob($attrs.names));
		$scope.devices = [];
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
		console.log($scope.random_int(0,1));
	}
	
	$scope.isSelected = function(index){
		if(index==$scope.selectedDevice){
			return true;
		}
		else{
			return false;
		}
	}
	
	$scope.setContrast = function(value){
		$scope.contrast = value;
	}
	
	$scope.setDataToSend = function(){
		//datos de la configuración
		var data = {
			"dificultadCromatica" : $scope.difCrom,
			"color_principal" : $scope.colPrin,
			"color_secundario" : $scope.colSec,
			"barrido" : $scope.sistemaBarrido,
			"tiempo_barrido" : $scope.tiempoBarrido,
			"contraste" : $scope.contrast,
			"tam_letra" : $scope.fontSize,
			"reconocimiento_voz" : $scope.reconocimientoVoz,
			"retroalimentacion_voz" : $scope.respuestaPorVoz,			
			"retroalimentacion_vibracion" : $scope.vibracion,						
		}
		
		//Cada dispositivo tendra su propia layout definida
		var layouts = [];
		
		for(i in $scope.devices){
			var device = $scope.devices[i];
			//datos del layout
			var configLayout = {
				"id_dispositivo" : device["id_dispositivo"],
				"id_usuario" : $scope.idUsuario,
				"rotacion" : 0,
				"filas_vertical" : null,
				"columnas_vertical" : null,
				"filas_horizontal" : device.config.layout.horizontal[1],
				"columnas_horizontal" : device.config.layout.horizontal[0]
			}
			
			if(device.config.layout.verticalAllowed){
				configLayout["rotacion"] = 1;
				configLayout["columnas_vertical"] = device.config.layout.vertical[1];
				configLayout["filas_vertical"] = device.config.layout.vertical[0];
			}
			layouts.push(configLayout);
		}
		
		//console.log(data, layouts, $scope.idUsuario);
		
		//??
		//var dataEncoded = window.btoa(angular.toJson(data));
		//var layoutsEncoded = window.btoa(angular.toJson(layouts));
				
		dataToSend = window.btoa(angular.toJson({
			config: data,
			layout : layouts,
			id : $scope.idUsuario
		}));
		
		//console.log(dataToSend);
		
		//??
		/*$http.post("/H4A2/H4A/src/Controllers/configController.php", dataToSend).
		then(function(data, status, headers, config) {
			var requestData = data.data;
			var requestStatus = requestData.status;
			//console.log(data);
			if(requestStatus == 1){
				var configData = requestData.data;
				$scope.requestStatus = 1;
				console.log(window.atob(configData));
			}
			else{
				$scope.requestStatus = -1;
				console.log("Error al realizar la setConfig")
			}
		})*/
		
		$http.get("./insertConfig?data="+dataToSend).
		then(function(data, status, headers, config) {
			var requestData = data.data;
			var requestStatus = requestData.status;
			
			if(requestStatus == 1){
				var response = requestData.data;
				//$scope.requestStatus = 1;
				console.log(response);
			}
			else{
				console.log("Error al realizar peticion")
			}
		})
	}
		
	$scope.$watch("requestStatus", function(){
		if($scope.requestStatus == 1){
			$window.location.href = '/H4A/web/index_dev.php/setAssets?idUsuario='+$scope.idUsuario;
		}
	})
	
	$scope.isAllowed = function(){
		var allowed = $scope.devices[$scope.selectedDevice].config.layout.verticalAllowed;
		return allowed;
	}

	$scope.isDifCrom = function(){
		return $scope.difCrom;		
	}
	
	$scope.isSistBar = function(){
		return $scope.sistemaBarrido;		
	}
	
	$scope.isColSec = function(){
		return MostcolSec;		
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
		//console.log(DifCrom)
		if($scope.difCrom){
			$scope.difCrom = false;			
			$scope.colPrin = "";
			$scope.colSec = "";
		}
		else{
			$scope.difCrom = true;
			$scope.colPrin = $scope.colorMap.blue;
			$scope.colSec = $scope.colorMap.orange;
		}
	}
	$scope.setSistBar = function(){
		if($scope.sistemaBarrido){
			$scope.sistemaBarrido = 0;	
		}
		else{
			$scope.sistemaBarrido = 1;
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
	
	$scope.random_int = be_random_int;
	
	$scope.getElementHeight = function(){
		var baseHeight = 0;
		if($scope.isHorizontal()){
			baseHeight = 224;
		}
		else{
			baseHeight = 250;
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
		$scope.CPYe= "btn btn-yellow";
		$scope.CPBlu= "btn btn-primary";
		$scope.CPPur= "btn btn-purple";
		$scope.CSRed= "btn btn-danger";
		$scope.CSOr= "btn btn-warning";		
		$scope.CSYe= "btn btn-yellow";
		$scope.CSBlu= "btn btn-primary";
		$scope.CSPur= "btn btn-purple";
		MostcolSec=true;
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
				$scope.CPYe= "btn btn-yellow btn-lg active";
				Gama2=true;
				Gama1=false;
			break;
			case "blue":
				$scope.CPBlu= "btn btn-primary btn-lg active";
				Gama1=true;
				Gama2=false;
			break;
			case "purple":
				$scope.CPPur= "btn btn-purple btn-lg Lblanca active";
				Gama1=true;
				Gama2=false;
			break;
			}
		$scope.colPrin = $scope.colorMap[index];
		
		ColSec="";
	}
	$scope.btnSecolor = function(index){
		$scope.CSRed= "btn btn-danger";
		$scope.CSOr= "btn btn-warning";		
		$scope.CSYe= "btn btn-yellow";
		$scope.CSBlu= "btn btn-primary";
		$scope.CSPur= "btn btn-purple";
		switch (index){
			case "red":
				$scope.CSRed= "btn btn-danger btn-lg active";
			break;
			case "orange":
				$scope.CSOr= "btn btn-warning btn-lg active";
			break;
			case "yellow":
				$scope.CSYe= "btn btn-yellow btn-lg active";
			break;
			case "blue":
				$scope.CSBlu= "btn btn-primary btn-lg active";
			break;
			case "purple":
				$scope.CSPur= "btn btn-purple Lblanca btn-lg active";
			break;
			}
		$scope.colSec = $scope.colorMap[index];
	}
	
	$scope.echo = function(){
		
		var ob ={
			action : "ping"
		};
		//arfu = angular.toJson(arfu);
		
		$http.get("./echo?data="+window.btoa(angular.toJson(ob))).
		then(function(data, status, headers, config) {
			var requestData = data.data;
			var requestStatus = requestData.status;
			//console.log(data);
			if(requestStatus == 1){
				var response = requestData.data;
				console.log(configData);
			}
			else{
				console.log("Error al realizar peticion")
			}
		})
		
	}
	
	$scope.sinfo = function(){
		console.log($scope)
	}
	
	$scope.init();
	$scope.sinfo();
});