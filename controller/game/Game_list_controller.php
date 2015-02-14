<?php
/*
 * 获取游戏列表及其作者
 */
class Game_list_controller extends Controller{
	function __construct($isSql=FALSE){
		parent::__construct($isSql);
	}
	
	public function set_param($paramArr){
		$result = TRUE;
		$data = null;	
		
		$type = null;
		
		if(isset($paramArr['type'])){
			$type = $paramArr['type'];
			switch ($type) {
				case 'game_list':
					$data = $this->get_game_list();
					break;
				default:
					break;
			}
			
		}else{
			$result = FALSE;
			$data = 'param has not type';
		}
		
		return array(
			'result' => $result,
			'data' => $data
		);
	}
	private function get_game_list(){
		$this->load('games/Game_list.php');
		
		$result =  $this->Game_list->query_list();
		
		return $result;
	}
}

?>