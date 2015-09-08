app.controller('help', ['$scope','helpProvider','$sce', function($scope, helpProvider, $sce) {

	$scope.helpData = JSON.parse(JSON.stringify(helpProvider.getAll()));
	
	var currentToken = 0;
	
	//Variable que indica si los elementos de ayuda se pueden hacer no visibles o no
	var thereIsHidden = true; 
	//array con los documentos de ayuda que serán visibles en el primer momento
	var visibleHelps = ['h4all','helpSystem'];
	//array con los documentos estáticos, es decir aquellos que no se cierran
	var staticHelps = ["helpSystem"]
	
	$scope.idIndexer = {};
	$scope.tagIndexer = {};
	$scope.menuOpen = false;
	
	/*Define que elementos tendrá el menu*/
	$scope.menuItems = ["#inicio","#tutor","#usuario","#dispositivo","&#MAC"];
	
	/*menu formateado, variable deriva de menuItems*/
	$scope.formatedMenu = [];
	
	$scope.createMenu = function () {
		for(i in $scope.menuItems) {
			var itag = $scope.menuItems[i];
			if(itag.match(/&/g)){
				alevel = itag.match(/&/g).length
			}
			else {
				alevel = 0;
			}
			var sitag = itag.replace("&","");
			var aitems = $scope.tagIndexer[sitag];
			var dataMenuItem = {title : sitag, level : alevel, items : aitems};
			$scope.formatedMenu.push(dataMenuItem);
		}
	}
	
	$scope.clickMenu = function() {
		if($scope.menuOpen) {
			$scope.menuOpen = false;
		}
		else {
			$scope.menuOpen = true;
		}
	}
	
	$scope.vars = {
		a : null,
		b : null
	}
	
	$scope.getMargin = function(level) {
		var n_margin = level * 15;
		var s_margin = n_margin+"px";
		return s_margin;
	}
	
	var init = function(){
		for(i in $scope.helpData) {
			var currentID = $scope.helpData[i].id;
			$scope.helpData[i].type = "data";
			if(!thereIsHidden){
				/*$scope.helpData[i].show = true;
				$scope.helpData[i].token = currentToken;
				currentToken += 1;*/
				$scope.setVisible($scope.helpData[i]);
			}
			else {
				if(visibleHelps.indexOf(currentID)>-1) {
					/*$scope.helpData[i].show = true;
					$scope.helpData[i].token = currentToken;
					currentToken += 1;*/
					$scope.setVisible($scope.helpData[i]);
				}
				else {
					$scope.helpData[i].show = false;
				}
			}
			
			$scope.helpData[i].bodySafe = [];
			
			for(j in $scope.helpData[i].body) {
				$scope.helpData[i].bodySafe.push($sce.trustAsHtml($scope.helpData[i].body[j]))
				
			}
			
			$scope.idIndexer[currentID] = $scope.helpData[i];
			
			for(j in $scope.helpData[i].tags){
				var itag = $scope.helpData[i].tags[j];
				if($scope.tagIndexer[itag] == null){
					$scope.tagIndexer[itag] = [];
					$scope.tagIndexer[itag].push(currentID);
				}
				else {
					$scope.tagIndexer[itag].push(currentID);
				}
			}
		}
		$scope.createMenu();
	}
	
	
	/*Está en JQUERY lo suyo sería pasarlo a angular puro*/
	$('body').ready(function() {
		$('.helpLink').click(function(event) {
			clickLink(event);
			
		});
	})
	var clickLink = function (event) {
		console.log("internal link clicked");
		var linked_id = event.target.id;
		$scope.setVisible($scope.idIndexer[linked_id]);
		/*$scope.idIndexer[linked_id].show = true;
		$scope.helpData[i].token = currentToken;
		currentToken += 1;*/
		
		$scope.$apply();
		console.log($('.helpLink'));
		$('.helpLink').click(clickLink);
	}
	//Fin arreglo provisional
	
	$scope.setVisible = function(ho) {
		ho.show = true;
		ho.token = currentToken;
		currentToken += 1;
	}
	
	$scope.close = function(ho) {
		ho.show = false;
	}

	$scope.isClosable = function(id) {
		if(staticHelps.indexOf(id)>-1){
			return false;
		}
		else {
			return true;
		}
	}
		
		
	$scope.clickTag = function(tag) {
		
		var listLinks = [];
		var resultados = $scope.tagIndexer[tag];
		
		for(i in resultados) {
			listLinks.push(resultados[i]);
		}
		
		var newSearch = {title : "Temas con la etiqueta: "+tag, links:listLinks, token : currentToken, show:true, type:"list"};
		currentToken += 1;
		$scope.helpData.push(newSearch)		
	}
	
	$scope.sinfo = function () {
		console.log($scope.helpData);
		console.log($scope.idIndexer);
		console.log($scope.tagIndexer);
		console.log($scope.formatedMenu);
	}
	
	init();
}]);