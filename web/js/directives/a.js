app.directive('resizeDispacher', function($rootScope,$scope,$parse,$sce,$window){
	return {
		restrict: 'A',

		link: function(scope, element, attrs) {
			angular.element(window).on('resize', function(){
				var currentWidth = angular.element(window).width();
				var currentHeight = angular.element(window).height();
				$rootScope.$broadcast('windowResize',{height : currentHeight, width : currentWidth});
			})
		}
	}
});