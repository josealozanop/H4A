app.directive('arrowToUp',[function($rootScope,$window,$timeout){

    return {
        restrict : 'EA',
       	template: "<div class='visible-xs arrow_to_up' ng-show='display'><a ng-click='toTop()'><i class='fa fa-angle-double-up fa-3x'></i></a></div>",

        link:function($scope,$element,$attr){
				
        },
		
		controller : function ($scope,$element,$timeout) {
			$scope.display = false;
			
			$scope.toTop = function (){
				window.scrollTo(0, 0);
			}
			
			angular.element(window).on('scroll', function(){
				if(window.pageYOffset > 50){
					$scope.display = true;
						
				}
				else{
					$scope.display = false;
				}
				$scope.$apply();
			})
		},
    }
}]);