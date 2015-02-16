<?php
/*
 * Game_list表操作
 */

 class Game_list extends Model {

	private $developerTname = 'developer';
	
	private $gameTname = 'game_list';

 	public function query_list(){
		$developerTname = $this->developerTname; 		
		$gameTname = $this->gameTname;
		
		$listSql = "SELECT $developerTname.developer_name, $gameTname.g_name, $gameTname.g_logo,$gameTname.g_url 
					FROM $gameTname INNER JOIN $developerTname";
		
		$sqlop = $GLOBALS['SqlOp'];
		if($sqlop->queryTo($listSql)){
			$resultArr = array();
			
			while ($r = mysql_fetch_array($sqlop->result)) {
				$resultArr[] = $r;
			}

			$tmpArr = array();
			foreach ($resultArr as $key => $value) {
				$tmpChildArr = array();			
				foreach ($value as $key => $value) {
					if(is_string($key)){
						$tmpChildArr[$key] = $value;
					}
				}
				$tmpArr[] = $tmpChildArr;
			}
			return $tmpArr;
		}else{
			return null;
		}
 	}
	public function add(){
	}
	public function remove(){
	}
 }
?>