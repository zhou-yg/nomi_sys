<?php
/*
 * User_list表的操作
 *  
 */
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
	public function remove(){
		
	}
	/*
	 * 数据列对应
	 * 条件
	 */
	public function update($param,$where){
		$result = TRUE;
		$data = null;
		
		$tname = $this->tname;
		$updateSql = "UPDATE $tname SET ";

		
		if(is_array($param)){
			
			
			foreach ($param as $columnName => $value) {
				
				$updateSql .= $columnName.'='."'$value' ,";
			}
			$updateSql = trim($updateSql,',');
			$updateSql .= 'where '.$where;
			
			$sqlop = $GLOBALS['SqlOp'];	
			if($sqlop->queryTo($updateSql)){
				
			}else{
				$result = FALSE;
				$data   = 'update fail';
			}
		}else{
			$result = FALSE;
			$data   = 'data isnt array';
		}	
		
		return array(
			'result' => $result,
			'data'   => $data
		);
	}
	public function query(){
	}
}