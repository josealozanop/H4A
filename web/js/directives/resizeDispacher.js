app.directive('resizeDispacher', ['$rootScope', function($rootScope,$scope,$parse,$sce,$window) {
	return {
		restrict: 'A',

		link: function(scope, element, attrs) {
			var width  = angular.element(window).width();
			var height = angular.element(window).height();
			
			var position = "horizontal";
			if(height > width){
				position = "vertical";
			}
			
			angular.element(window).on('resize', function(){
				var currentWidth = angular.element(window).width();
				var currentHeight = angular.element(window).height();
				//console.log(currentWidth, currentHeight);
				$rootScope.$broadcast('windowResize',{height : currentHeight, width : currentWidth});
				if(position == "horizontal" && currentWidth < currentHeight){
					position = "vertical";
					//console.log("cambiamos a vertical");
					$rootScope.$broadcast('screenChange', {position : "vertical"});
				}
				else if(position == "vertical" && currentWidth > currentHeight){
					position = "horizontal";
					//console.log("cambiamos a horizontal");
					$rootScope.$broadcast('screenChange', {position : "horizontal"});
				}
			})
			
		}
	}
}]);