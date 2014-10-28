<?php
	//Мб как то замутить операции с таблицами с помощью наследования и полиморфизма.
	
	//Как будет выглядеть таблица answers
	
	class Model {
		
		private $db;
		
		public function __construct() {
			try {
				$this->db = new PDO("mysql:host=".Config::$dbCfg["host"].";dbname=".Config::$dbCfg["dbName"],
                        Config::$dbCfg["userName"], Config::$dbCfg["password"]);
				
				
			} catch (PDOException $e) {
				//пока не понятно что мы делаем
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
	}