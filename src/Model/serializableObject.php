<?php
	/**
		This file is an extension of the object FR_Object created by Joe Stump in his book "Understanding MVC in PHP"
		This file has been modified by Borja Molina Zea, borja.mz8'at~gmail.com
	**/
	
abstract class serializableObject{
		/**
		* $me
		*
		* @var mixed $me Instance of ReflectionClass
		*/
		protected $me;

		/**
		* __construct
		* 
		* @author Joe Stump <joe@joestump.net>
		* @access public 
		*/
		public function __construct(){
			$this->me = new ReflectionClass($this);
		}

	/**
	* setFrom
	*
	* @author Joe Stump <joe@joestump.net>
	* @access public
	* @param mixed $data Array of variables to assign to instance
	* @return void
	*/
	public function fromArray($data){
		if (is_array($data) && count($data)){
			$valid = get_class_vars(get_class($this));
			foreach ($valid as $var => $val) {
				if (isset($data[$var])) {
					$this->$var = $data[$var];
				}
			}
		}
	//echo $this->color1;
	}

		/**
		* toArray
		*
		* @author Joe Stump <joe@joestump.net>
		* @access public
		* @return mixed Array of member variables keyed by variable name
		*/
		public function toArray(){
			$defaults = $this->me->getDefaultProperties();
			$return = array();
			foreach ($defaults as $var => $val) {
				if ($this->$var instanceof serializableObject) {
					$return[$var] = $this->$var->toArray();
				} else {
					if($var != "me"){
						$return[$var] = $this->$var;
					}
				}
			}
  
			return $return;
		}

		
		public function toJson(){
			return json_encode($this->toArray());
		}
		
		public function fromJson($data){
			$data = json_decode($data, true);
			$this->fromArray($data);
		}
		
		public function fromBase64($data){
			$data = base64_decode($data);
			$this->fromJson($data);
		}
		
		public function toBase64(){
			return base64_encode($this->toJson());
		}
}
?>