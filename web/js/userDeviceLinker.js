app.controller('userDeviceLinker', ['$scope', 'asyncServices', '$attrs', function($scope,asyncServices,$attrs) {

	var services = asyncServices;
	var current_idUsuario = $attrs.idUsuario;
	
	console.log("id del usuario creado:");
	console.log(current_idUsuario);
	
	services.getMyDevices.init()
		.success(function(data, status, headers, config) {
			$scope.raw_data = data;
			for(i in $scope.raw_data) {
				var currentDevice = $scope.raw_data[i];
				$scope.allDevices.push(new Device(currentDevice.nombre_dispositivo,currentDevice.mac_dispositivo,currentDevice.uDefecto_dispositivo));
			}
		})
		.error(function(data, status, headers, config) {
			console.log("ERROR el servicio ");
		});
		
	function Device(name, MAC, UDefault) {
		this.name = name,
		this.MAC = MAC,
		this.UDefault = UDefault,
		this.selected = false,
		this.select = function() {
			if(this.selected) {
				this.selected = false;
			}
			else {
				this.selected = true;
			}
		}
	}
	
	$scope.allDevices = new Array();
	$scope.selectedDevices = new Array();
	
	$scope.queryInsert = {
		status : "noInit",
		msg : ""
	}
	
	
	/*$scope.allDevices.push(new Device("mi tablet","4a-db-6a-cd",""));
	$scope.allDevices.push(new Device("mi movil","4a-db-8a-cd",""));
	$scope.allDevices.push(new Device("sony xperia","4a-dg-6a-cd",""));
	$scope.allDevices.push(new Device("s5","4a-db-7a-cd",""));
	$scope.allDevices.push(new Device("iphone","4a-db-6a-cg",""));
	$scope.allDevices.push(new Device("lg g3","5a-db-6a-cd",""));
	$scope.allDevices.push(new Device("nada","4a-hb-6a-cd",""));*/
	
	$scope.newDevice = {
		wantNewDevice : false,
		useThisMAC : false,
		defaultWanted : false,
		data : {
			name : "",
			MAC : "",
			UDefault : ""
		}
	};
	
	$scope.addDevice = function() {
		var nDevice = $scope.newDevice;
		var toAdd = new Device(nDevice.data.name,nDevice.data.MAC,nDevice.data.UDefault);
		$scope.selectedDevices.push(toAdd);
		if($scope.newDevice.defaultWanted) {
			$scope.indexOfDefault = $scope.selectedDevices.length-1;
		}
		
		var devideData = {
			MAC : nDevice.data.MAC,
			uDefault : ""
		}
		
		var linkDeviceTutorData = {
			idDispositivo : "",
			nombreDispositivo : nDevice.data.name,
			
		}
		
		var linkDeviceUserData = {
			idDispositivo : "",
			idUsuario : ""
		}
		
		services.insertDevice.init(JSON.stringify(devideData))
			.success(function(data, status, headers, config) {
				$scope.output = data;
				if(typeof data == "object"){
					console.log("dispositivo insertado");
					console.log(data);
					linkDeviceTutorData.idDispositivo = data[0].id_dispositivo;
					
					services.linkDeviceTutor.init(JSON.stringify(linkDeviceTutorData))
					.success(function(data, status, headers, config) {
						if(typeof data == "object"){
							$scope.queryInsert = {
								status : "success",
								msg : data
							}
							console.log("linkando dispositivo");
							console.log(data);
							
							
							
							//Limpiamos los datos
							$scope.newDevice = {
								wantNewDevice : false,
								useThisMAC : false,
								defaultWanted : false,
								data : {
									name : "",
									MAC : "",
									UDefault : ""
								}
							};
						}
						else{
							console.log("error en el linkado del dispositivo");
							$scope.queryInsert = {
								status : "error",
								msg : data
							}
						}
						
					})
				}
				else{
					console.log("error en el servicio insertDevice");
					$scope.queryInsert = {
						status : "error",
						msg : data
					}
				}
				
			})
			.error(function(data, status, headers, config) {
				console.log("ERROR en el servicio insertDevice");
			});
	}
	
	var dataToSend = {
		idUsuario: current_idUsuario,
		indexDefault : -1,
		macs : new Array()
	}
	$scope.formatedData = JSON.stringify(dataToSend);
	
	$scope.prepareData = function () {
		dataToSend.indexDefault = $scope.indexOfDefault;
		var ld = $scope.selectedDevices;
		for(i in ld) {
			dev = ld[i];
			dataToSend.macs.push(dev.MAC);
		}
		$scope.formatedData = JSON.stringify(dataToSend);
	}
	
	
	$scope.linkDevices = function() {
		var toPass = new Array();
		var rightDevices = JSON.parse(JSON.stringify($scope.allDevices));
		var newIndex = 0;
		for(d in rightDevices) {
			if(rightDevices[d].selected){
				rightDevices[d].selected = false;
				toPass.push(rightDevices[d]);
				$scope.allDevices.splice(d-newIndex,1);
				newIndex++;
			}
		}

		for(d in toPass) {
			$scope.selectedDevices.push(new Device(toPass[d].name,toPass[d].MAC,toPass[d].UDefault));
		}
	
	}
	
	$scope.unlinkDevices = function() {
		var toPass = new Array();
		var leftDevices = JSON.parse(JSON.stringify($scope.selectedDevices))
		var newIndex = 0;
		for(d in leftDevices) {
			if(leftDevices[d].selected){
				leftDevices[d].selected = false;
				toPass.push(leftDevices[d]);
				if(d==$scope.indexOfDefault) {
					$scope.indexOfDefault = -1;
				}
				$scope.selectedDevices.splice(d-newIndex,1);
				newIndex++;
			}
		}
			for(d in toPass) {
			$scope.allDevices.push(new Device(toPass[d].name,toPass[d].MAC,toPass[d].UDefault));
		}
	}
	
	$scope.sinfo = function() {
		console.log($scope.allDevices);
		console.log($scope.selectedDevices);
		console.log($scope.indexOfDefault);
		console.log($scope);
	}
	
	$scope.indexOfDefault = -1;
	$scope.doDefault = function(i) {
		$scope.indexOfDefault = i;
		console.log("dispostivio por defecto es el "+i);
	}

}]);