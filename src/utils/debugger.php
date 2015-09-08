<?php

class debugger{
	public static $enabled = true;
	
	public static $bdDebug = false;
	public static $bdEnabled = true;
	
	
	public static function bdEnabled(){
		return debugger::$enabled and debugger::$bdEnabled;
	}

}
?>