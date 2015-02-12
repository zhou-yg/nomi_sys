<?php

class User_list extends Model{
	
	private $tname = 'user_list';
	
	function __constructr(){
	}
	public function add($username,$clientToken){
		$this->lib('Sec_key.php');

		$result = TRUE;
		$data = null;
		
		if(isset($username)){
			$tname = $this->tname;

			$userToken = $this->Sec_key->create_token();
			
			$insertSql = "INSERT INTO $tname VALUES(NULL,'$clientToken','$userToken','$username')";
			
			$sqlop = $GLOBALS['SqlOp'];
			
			if($sqlop->queryTo($insertSql)){
				
			}else{
				$result = FALSE;
				$data = 'user query fail';
			}		
		}else{
			$result = FALSE;
			$data = 'username is unset';
		}
		
		return array(
			'result' => $result,
			'data' => $data
		);
	}
	public function remove($where){
	}
	public function update(){
	}
	public function query(){
	}
}