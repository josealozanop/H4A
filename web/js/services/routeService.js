app.service('routeService', function() {

	this.sanitizeImgRoute = function(url){
		var sanitizedUrl =  url.replace(/(\/index.php)|(\/index_dev.php)/, "");;
		return sanitizedUrl;
	}		
	
	return this;
	
});