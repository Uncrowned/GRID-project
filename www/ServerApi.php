<?php 
	//еще бы url manager замутить не плохо
	class ServerApi {
		
		private $model;
		
		private $coder;
		
		private $decoder;
		
		public function __construct() {
			$this->model = new Model();
			$this->coder = new Coder();
			$this->decoder = new Decoder();
		}
		
		public function getTask($id) {
			$node = $this->model->selectNodeBy("id", $id);
			if(empty($node)) {
				$this->coder->renderError("Can't find Node with ID = ".$id);
			}
		}
		
		public function setTaskDone($id, $answer) {
		
		}

		public function shutdown($id) {
		
		}

		public function saveFile($file) {
			
		}
		
		public function register($name, $type) {
			$node = new Node($name, $type);
			
			$sql = "INSERT INTO nodes SET name=:name, ip=:ip, status=:status, date_registration=:date, rang=:rang, type=:type";
			$arg = array(":name" => $node->getName(), ":ip" => $node->getIP(true), ":status" => $node->getStatus(), 
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