<?php

class Devices extends Model{
	
	private $tname = 'user_devices';
	
	function __construct(){
	}
	public function add($deviceMsgArr){
		
		$tname = $this->tname;
		$brand = $deviceMsgArr['brand'];
		$sys   = $deviceMsgArr['sys'];
		
		$this->lib('Sec_key.php');
		$clientToken = $this->Sec_key->create_token();
		
		$sqlop = $GLOBALS['SqlOp'];
		$insertDeviceSql = "INSERT INTO $tname VALUES('$brand','$sys','$clientToken')";

		$insertResult = $sqlop->queryTo($insertDeviceSql);
		
		return $insertResult?$clientToken:$insertResult;
	}
	public function remove(){
		
	}
}

?>