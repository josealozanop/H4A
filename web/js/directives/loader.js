app.directive('loader',[function($rootScope, $window){

    return {
        restrict : 'EA',
       	//templateUrl: "js/directives/templates/loader.html",
		template:'<div class="row">	<div class="col-xs-12" style="text-align:center"> <i class="fa fa-refresh fa-spin fa-4x"></i><br><p>Obteniendo datos...</p>	</div></div>',

        link:function($scope,$element,$attr){	
        },
		
		controller : function ($scope,$element) {
		}
    }
}]);