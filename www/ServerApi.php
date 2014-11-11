<?php 
	//еще бы url manager замутить не плохо
	class ServerApi {
		
		private $model;
		
		private $coder;
		
		private $decoder;
		
		public function __construct() {
			$this->model = new GridModel();
			$this->coder = new Coder();
			$this->decoder = new Decoder();
		}
		
		public function getTask($id) {
			$node = $this->recieveNodeById($id);
			
			$sql = "SELECT * FROM tasks WHERE status=:status AND type=:type";
			$arg = array(":status" => Config::$statusTask[0], ":type" => $node->getType());
			
			$tasks = $this->model->select($sql, $arg);
			if (empty($tasks)) {
				$this->coder->renderError("No available tasks.");
				exit; //?
			}
			
			$this->model->changeNodeStatus($node->getId(), Config::$statusNod[1]);
			$this->model->changeTaskStatus($tasks[0]["id"], Config::$statusTask[1]);
			
			//insert into schedule
			$sql = "INSERT INTO schedule SET node_id=:node, task_id=:task, date_get=:date, date_refresh=:refresh";
			$arg = array(":node" => $node->getId(), ":task" => $tasks[0]["id"], ":date" => time(), ":refresh" => time());
			$this->model->insert($sql, $arg);
			
			$this->coder->renderTask($node->getId(), new Task($tasks));
		}
		
		public function setTaskDone($nodeId, $taskId, $answer) {
			$this->model->changeNodeStatus($nodeId, Config::$statusNode[0]);
			$this->model->changeTaskStatus($taskId, Config::$statusTask[2]);
			
			$sql = "INSERT INTO answers SET value=:value, date=:date, task_id=:task, node_id=:node"
			$arg = array();
			$this->model->insert($sql, $arg);
			
			//update or delete schedule
			
			$this->coder->renderOk();
		}
		
		private function recieveNodeById($id) {
			$node = $this->model->selectNodeBy("id", $id);
			if(empty($node)) {
				$this->coder->renderError("Can't find Node with ID = ".$id);
				exit; //?
			}
			
			return $node;
		}
		
		public function shutdown($id) {
			$node = $this->recieveNodeById($id);
			
			$sql = "SELECT * FROM schedule WHERE node_id=:node";
			$arg = array(":node" => $node->getId());
			
			$schedule = $this->model->select($sql, $arg);
			if (!empty($schedule)) {
				$sql = "DELETE FROM schedule WHERE node_id=:node AND task_id=:task";
				$arg = array(":node" => $schedule["node_id"], ":task" => $schedule["task_id"]);
				$this->model->delete($sql, $arg);
				
				$this->model->changeTaskStatus($schedule["task_id"], Config::$statusTask[0]);
			}
			
			$this->model->changeNodeStatus($node->getId(), Config::$statusNode[2]);
			
			$this->coder->renderOk();
		}

		public function saveFile($file) {
			
		}
		
		public function register($name, $type) {
			$node = new Node($name, $type);
			
			$sql = "INSERT INTO nodes SET name=:name, ip=:ip, status=:status, date_registration=:date, rang=:rang, type=:type";
			$arg = array(":name" => $node->getName(), ":ip" => $node->getIp(true), ":status" => $node->getStatus(), 
				":date" => $node->getDate(), ":rang" => $node->getRang(), ":type" => $node->getType());
			
			$this->model->insert($sql, $arg);
			
			$this->coder->renderNodeId($this->model->lastInsertId());
		}
		
		public function getStat() {
		
		}
		
		public function recieveGlobalTask($task) {
			$tasks = $this->decoder->convertTask($task);
			
			$sql = "INSERT INTO tasks SET";
			foreach($tasks as $one) {
				$arg = array();
				
				$this->model->insert($sql, $arg);
			}
			
			$this->coder->renderOk();
		}
	}