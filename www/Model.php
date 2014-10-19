<?php
	//�� ��� �� �������� �������� � ��������� � ������� ������������ � ������������.
	
	//��� ����� ��������� ������� answers
	
	class Model {
		
		private $db;
		
		public function __construct() {
			try {
				$this->db = new PDO("mysql:host=".Config::$dbCfg["host"].";dbname=".Config::$dbCfg["dbName"],
                        Config::$dbCfg["userName"], Config::$dbCfg["password"]);
				
				
			} catch (PDOException $e) {
				//���� �� ������� ��� �� ������
			}
		}
		
		public function select($sql, $arg = null) {
			$result = $this->execute($sql, $arg);
			
			return !$result ? false : $query->fetchAll();
		}
		
		public function delete($sql, $arg = null) {
			return $this->changeRecord($sql, $arg);
		}
		
		private function changeRecord($sql, $arg) {
			$result = $this->execute($sql, $arg);
			
			return !$result ? false : true;
		}
		
		public function insert($sql, $arg = null) {
			return $this->changeRecord($sql, $arg);
		}
		
		private function execute($sql, $arg) {
			$query = $this->db->prepare($sql);
			if (empty($arg)) {
				$result = $query->execute();
			} else {
				$result = $query->execute($arg);
			}
			
			if (!$result) {
                $error = $query->errorInfo();
                //Log::showError($errorMsg." => ".$error[2]);
                return false;
            }
			return $query;
		}
		
		public function update($sql, $arg = null) {
            return $this->changeRecord($sql, $arg);
		}
		
		public function getLastInsertId() {
			return $this->db->lastInsertId();
		}
		
		public function selectNodeBy($field, $value) {
			$sql = "SELECT * FROM nodes WHERE ".$field."=:value";
			$arg = array(":value" => $value);
			
			$result = $this->select($sql, $arg);
			$count = count($result);
			if (empty($result) || $count > 1) {
				return false;
			}
			
			$node = new Node($result["name"], $result["type"]);
			$node->setRang($result["rang"]);
			$node->setStatus($result["status"]);
			$node->setDate($result["date_registration"]);
			$node->setIP($result["ip"]);
			$node->setID($result["id"]);
			
			return $node;
		}
	}