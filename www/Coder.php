<?php 

$coder = new Coder();
$coder->renderOk();

class Coder {
	
	public function renderOk() {
		$message = array('answer'=>true);
		echo json_encode($message);
	}
	
	public function renderError($error) {
	
	}
	
	public function renderNodeId($id) {
	
	}
	
	public function renderTask($taskId, $task) {
	
	}
}