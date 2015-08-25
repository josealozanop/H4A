app.service('speakerService', function($http, $rootScope, clientInfo) {

	this.init = function(os){
		this.status = 2;
		var googleIp = "google.es";
		/**
			Engines
			0 => google
			1 => mespeak
		**/
		this.engine = 0;
		
		try{
			new ping(googleIp, function (googleStatus, e) {
				if(googleStatus == "responded"){
					this.status = 1;
					//console.log("google is online");
					$rootScope.$broadcast('googleOnline');
				}
				else{
					this.status = 0;
					//console.log("google is offline");
					$rootScope.$broadcast('googleOffline');
				}
			});
		}
		catch(err){
			//console.log("El equipo no tiene conexión a internet");
			$rootScope.$broadcast('googleOffline');
			this.status = 0;
		}
		
		var browser = clientInfo.getBrowser();
		//console.log(browser);
		//Si google esta offline (o no hay conexion) y el explorador no es chrome o safari entonces activamos mespeak
		if(this.status == 0 || !navigator.onLine || !'speechSynthesis' in window || (browser != "chrome" && browser != "safari")){
		//if(true){
			this.engine = 1;
			if(os == 0){
				var basePath = "/H4A2/H4A/web/";
			}
			else{
				var basePath = "/H4A/web/";
			}
			meSpeak.loadConfig(basePath+"mespeak_config.json");
			meSpeak.loadVoice(basePath+'voices/es.json');
		}		
	}		
	
	this.speak = function(msg){
		if(this.engine == 0){
			window.speechSynthesis.speak(newSpeak(msg));
		}
		else if(this.engine == 1){
			meSpeak.speak(msg);
		}
	}
	
	var newSpeak = function(msg){
		var speech = new SpeechSynthesisUtterance(msg);
		speech.lang = 'es-ES';
		return speech;
	}
	
	/**
		from:
		http://stackoverflow.com/questions/4282151/is-it-possible-to-ping-a-server-from-javascript
	**/
	var ping = function(ip, callback) {

		if (!this.inUse) {
			this.status = 'unchecked';
			this.inUse = true;
			this.callback = callback;
			this.ip = ip;
			var _that = this;
			this.img = new Image();
			this.img.onload = function () {
				_that.inUse = false;
				_that.callback('responded');

			};
			this.img.onerror = function (e) {
				if (_that.inUse) {
					_that.inUse = false;
					_that.callback('responded', e);
				}

			};
			this.start = new Date().getTime();
			this.img.src = "http://" + ip;
			this.timer = setTimeout(function () {
				if (_that.inUse) {
					_that.inUse = false;
					_that.callback('timeout');
				}
			}, 4500);
		}
	}
	
	var echo = function(msg){
		if(msg){
			console.log(msg);
		}
		else{
			console.log("echo");
		}
	}
	
	return this;
	
});