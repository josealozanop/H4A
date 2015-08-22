app.service('speakerService', function() {

	this.init = function(os){
		this.started = 1;
		console.log("inicializando...");
		if(os == 0){
			var basePath = "/H4A2/H4A/web/";
		}
		else{
			var basePath = "/H4A/web/";
		}
		
		meSpeak.loadConfig(basePath+"mespeak_config.json");
		meSpeak.loadVoice(basePath+'voices/es.json');
		
	}		
	
	this.speak = function(msg){
		if(this.started == 1){
			window.speechSynthesis.speak(newSpeak(msg));
			meSpeak.speak(msg);
		}
	}
	
	var newSpeak = function(msg){
		var speech = new SpeechSynthesisUtterance(msg);
		speech.lang = 'es-ES';
		return speech;
	}
	
	return this;
	
});