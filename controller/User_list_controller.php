<?php

class User_list_controller extends Controller{
	
	function __construct(){
		parent::__construct(TRUE);
		$this->load('useres/User_list.php');
	}
	public function set_param($paramArr){

		$result = null;

		if(isset($paramArr['type'])){
			$type = $paramArr['type'];
				
			switch ($type) {
				case 'add':
					$result = $this->add_user($paramArr);
					break;
				default:
					break;
			}		
			
		}else{
			$result = 'type is null';
		}
		
		$this->close();
		
		return $result;
	}
	/*
	 * 新增一个User，并关联一个device
	 * 
	 * 新设备
	 * $paramArr = array(
	 * 	  username
	 *    brand
	 *    sys
	 * )
	 * 旧设备
	 * $paramArr = array(
	 *    username
	 *    clientToken
	 * )
	 * 
	 */
	private function add_user($paramArr){
		$result = TRUE;
		$data = null;

		if(isset($paramArr['username'])){
			$username = $paramArr['username'];
		}else{
			$result = FALSE;
			$data = 'username is undefined';
		}
		if($result){
			if(isset($paramArr['clientToken'])){
				//旧
				$clientToken = $paramArr['clientToken'];
				$data = $this->User_list->add($username,$clientToken);
			}else{
				//新
				if(isset($paramArr['brand']) && isset($paramArr['sys'])){
					$this->load('useres/Devices.php');
					$clientToken = $this->Devices->add($paramArr);

					if($clientToken){
						$data = $this->User_list->add($username,$clientToken);
					}else{
						$result = FALSE;
						$data = 'add device fail';
					}
				}else{
					$result = FALSE;
					$data = 'unset brand or sys';
				}
			}
		}	
		return array(
			'result' => $result,
			'data'   => $data
		);
	}
}

?>