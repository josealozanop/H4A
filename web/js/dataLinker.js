app.service('dataLinker', function(){
		var a;
		this.get = function(){
		return a;
		}
		this.set = function(b){
			a=b;
		}
		return this;
}