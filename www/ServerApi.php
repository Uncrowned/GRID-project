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
			$arg = array(":status" => Config::$statusTask[0], "type" => $node->getType());
			
			$tasks = $this->model->select($sql, $arg);
			if (empty($tasks)) {
				$this->coder->renderError("No available tasks.");
				exit; //?
			}
			
			$sql = "UPDATE tasks SET status=:status WHERE id=:id";
			$arg = array(":status" => Config::$statusTask[1], ":id" => $tasks[0]["id"]);
			$this->model->update($sql, $arg);
			
			$this->coder->renderTask(new Task($tasks));
		}
		
		public function setTaskDone($id, $answer) {
			/**
			*
			*
			*
			*/
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
				
				$sql = "UPDATE task SET status=:status WHERE id=:id";
				$arg = array(":status" => Config::$statusTask[0], ":id" => $schedule["task_id"]);
				$this->model->update($sql, $arg);
			}
			
			$sql = "UPDATE nodes SET status=:status WHERE id=:id";
			$arg = array(":status" => Config::$statusNode[2], ":id" => $node->getId());
			$this->model->update($sql, $arg);
			
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
			
			foreach($tasks as $one) {
				$sql = "INSERT INTO tasks SET";
				$arg = array();
				
				$this->model->insert($sql, $arg);
			}
			
			$this->coder->renderOk();
		}
	}