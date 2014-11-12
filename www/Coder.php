<?php 

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
	    	$message = array('answer' => array('nodeId' => $id));
		echo json_encode($message);
	}
	
	public function renderTask($nodeId, $task) {
		$message = array('answer' => array(
			'nodeId' => $nodeId,
			'task' => $task
			));
		echo json_encode($message);
	}
}
