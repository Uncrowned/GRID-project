<?php 
$mes= "Artur loh";
$coder = new Coder();
//$coder->renderOk();
$coder->renderError($mes);

class Coder {
	
	public function renderOk() {
		$message = array('answer' => true);
		echo json_encode($message);
	}
	
	public function renderError($error) {
		$message = array('answer' => array('error' => $error));
		echo json_encode($message);
	}
	
	public function renderNodeId($id) {
	
	}
	
	public function renderTask($nodeId, $task) {
	
	}
}