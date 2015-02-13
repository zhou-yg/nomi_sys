<?php
class Get_token extends Controller{
	
	function __construct(){
	}
	
	public function set_param(){
		$this->lib('Sec_key.php');
		return $this->Sec_key->create_token();
	}
}
?>