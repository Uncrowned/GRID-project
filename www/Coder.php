<?php 
$mes= "��� ������";
$coder = new Coder();
//$coder->renderOk();
$coder->renderError($mes);

class Coder {
	
	public function renderOk() {
		$message = array('answer'=>true);
		echo json_encode($message);
	}
	
	public function renderError($error) {
    var_dump($error);
	  $message = array('answer'=>array('error'=>$error));
		echo json_encode($message);
	}
	
	public function renderNodeId($id) {
	
	}
	
	public function renderTask($taskId, $task) {
	
	}
}