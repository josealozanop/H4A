app.directive('inlineHelp', ['helpProvider', function(helpProvider) {
	return {
        restrict : 'EA',
       	templateUrl: '/H4A/web/templates/inlineHelp.html',
		replace : true,
		scope: true,

        link:function($scope,$element,$attr,$window){
			$scope.body = helpProvider.getInlineHelp($attr.idHelp);
        },
		
		controller : function ($scope,$element,$timeout) {
			$('[data-toggle="popover"]').popover({
				placement : 'bottom',
				html : "true"
			});
			
		}	
		
    }
}])