<?php 
	//еще бы url manager замутить не плохо
	class ServerApi {
		
		private $model;
		
		private $coder;
		
		public function __construct() {
			$this->model = new Model();
			$this->coder = new Coder();
		}
		
		public function getTask($node) {
			
		}
		
		public function setTaskDone($node) {
		
		}

		public function shutdown($node) {
		
		}

		public function register($name) {
			$ip = $_SERVER['REMOTE_ADDR'];
			$node = new Node($ip, $name);
			
			$sql = "INSERT INTO nodes SET name=:name, ip=:ip, status=:status, date_registration=:date, rang=:rang";
			$arg = array(":name" => $node->getName(), ":ip" => $node->getIP(), ":status" => $node->getStatus(), ":date" => $node->getDate(), ":rang" => $node->getRang());
			
			$this->model->insert($sql, $arg);
			
			$this->coder->renderNodeId($this->model->lastInsertId());
		}
		
		public function getStat() {
		
		}
		
		public function recieveGlobalTask($task) {
		
		}
	}