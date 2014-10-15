<?php 
	
	class Node {
		//Нужно добавить тип ноды
		private $id;
		
		private $name;
		
		private $rang;
		
		private $status;
		
		private $ip;
		
		private $dateTime;
		
		public function __construct($ip = null, $name = null, $isNew = false) {
			if (!empty($ip)) {
				$this->setIP($ip);
			}
			
			if (!empty($name)) {
				$this->setName($name);
			}
			
			if ($isNew) {
				$this->setRang();
				$this->setDate();
				$this->setStatus(Config::$statusNode["free"]);
			}
		}
		
		public function getID() {
			return $this->id;
		}
		
		public function getStatus() {
			return $this->status;
		}
		
		public function getDate() {
			return $this->dateTime;
		}
		
		public function getName() {
			return $this->name;
		}
		
		public function getIP($isLong = false) {
			if ($isLong) {
				return ip2long($this->ip);
			} else {
				return $this->ip;
			}
		}
		
		public function getRang() {
			return $this->rang;
		}
		
		public function setRang($rang = null) {
			if (!empty($rang) && is_numeric($rang)) {
				$this->rang  = $rang;
			} else {
				$this->rang  = 0;
			}
		}
		
		public function setStatus($status) {
			if (in_array($status, Config::$statusNode)) {
				$this->status = $status;
			} else {
				///ААА какая то хрень вместо status
			}
		}
		
		public function setDate($date = null) {
			if (empty($date)) {
				$this->dateTime = time();
			} else {
				$this->dateTime = $date;
			}
		}
		
		public function setName($name) {
			$this->name = $name;
		}
		
		public function setIP($ip) {
			$this->ip = $ip;
		}
		
		public function setID($id) {
			if (is_numeric($id)) {
				$this->id = $id;
			} else {
				///ААА какая то хрень вместо id
			}
		}
	}
