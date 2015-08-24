/**
	from http://stackoverflow.com/questions/9847580/how-to-detect-safari-chrome-ie-firefox-and-opera-browser
**/

app.service('clientInfo', function() {
	
	this.browsers = ["ie", "firefox", "chrome", "opera", "safari"];
	
	this.getBrowser = function(){
		var isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
		// Opera 8.0+ (UA detection to detect Blink/v8-powered Opera)
		if(isOpera){
			return this.browsers[3];
		}
				
		var isFirefox = typeof InstallTrigger !== 'undefined';   // Firefox 1.0+
		if(isFirefox){
			return this.browsers[1];
		}		
		
		var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
			// At least Safari 3+: "[object HTMLElementConstructor]"
		if(isSafari){
			return this.browsers[4];
		}	
		
		var isChrome = !!window.chrome && !isOpera;              // Chrome 1+
		if(isChrome){
			return this.browsers[2];
		}
		
		var isIE = /*@cc_on!@*/false || !!document.documentMode; // At least IE6
		if(isIE){
			return this.browsers[0];
		}
		
		return "unknow";
	}
	
	return this;
})
