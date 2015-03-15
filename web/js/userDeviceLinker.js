app.controller('userDeviceLinker', ['$scope', function($scope) {
	
	function Device(name, MAC, UDefault) {
		this.name = name,
		this.MAC = MAC,
		this.UDefault = UDefault,
		this.selected = false,
		this.select = function() {
			console.log("hola");
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
	
	$scope.allDevices.push(new Device("mi tablet","4a-db-6a-cd",""));
	$scope.allDevices.push(new Device("mi movil","4a-db-8a-cd",""));
	$scope.allDevices.push(new Device("sony xperia","4a-dg-6a-cd",""));
	$scope.allDevices.push(new Device("s5","4a-db-7a-cd",""));
	$scope.allDevices.push(new Device("iphone","4a-db-6a-cg",""));
	$scope.allDevices.push(new Device("lg g3","5a-db-6a-cd",""));
	$scope.allDevices.push(new Device("nada","4a-hb-6a-cd",""));
	
	$scope.newDevice = {
		wantNewDevice : false,
		useThisMAC : false
	};
	
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
				$scope.selectedDevices.splice(d-newIndex,1);
				newIndex++;
			}
		}
			for(d in toPass) {
			$scope.allDevices.push(new Device(toPass[d].name,toPass[d].MAC,toPass[d].UDefault));
		}
	}

}]);