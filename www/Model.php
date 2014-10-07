<?php
	//Мб как то замутить операции с таблицами с помощью наследования и полиморфизма.
	
	//Как будет выглядеть таблица answers
	
	class Model {
		
		private $order;
		
		private $db;
		
		public function __construct() {
			$this->db = new PDO("mysql:host=".Config::$dbCfg["host"].";dbname=".Config::$dbCfg["dbName"],
                        Config::$dbCfg["userName"], Config::$dbCfg["password"]);
		}
	
		public function insertNode($node) {
		
		}
		
		public function selectNodeById($id) {
			
		}
		
		public function selectAllNodes() {
			
		}
		
		public function selectNodeByWhere($condition) {
		
		}
		
		public function setOrder($order) {
		
		}
		
		public function getOrder () {
		
		}
		
		public function deleteNodeById($id) {
		
		}
		
		public function deleteNodeByWhere($condition) {
		
		}
		
		public function updateNodeById($id) {
		
		}
		
		public function updateNodeByWhere($condition) {
		
		}
	}