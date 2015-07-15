app.service('screenService', function() {

	this.getScreenSize = function(){
		var width  = angular.element(window).width();
		
		if(width < 768){
			return 'xs';
		}
		else if(width >= 768 && width < 992){
			return 'sm';
		}
		else if(width >= 992 && width < 1200){
			return 'md';
		}
		else if(width >= 1200){
			return 'lg';
		}
		else{
			return 'undefined';
		}
	}		
	
	return this;
	
});