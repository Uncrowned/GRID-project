<?php 
	
	class Node {
		
		private $id;
		
		private $name;
		
		private $rang;
		
		private $status;
		
		private $ip;
		
		private $dateTime;
		
		private $type;
		
		public function __construct($name = null, $type = null, $isNew = false) {
			if (!empty($type)) {
				$this->setType($type);
			}
			
			if (!empty($name)) {
				$this->setName($name);
			}
			
			if ($isNew) {
				$this->setIP($_SERVER['REMOTE_ADDR']);
				$this->setRang();
				$this->setDate();
				$this->setStatus(Config::$statusNode[0]);
			}
		}
		
		public function getType() {
			return $this->type;
		}
		
		public function getId() {
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
		
		public function getIp($isLong = false) {
			if ($isLong) {
				return ip2long($this->ip);
			} else {
				return $this->ip;
			}
		}
		
		public function getRang() {
			return $this->rang;
		}
		
		public function setType($type) {
			if (in_array($type, Config::$typeNode)) {
				$this->type = $type;
			} else {
				///ААА какая то хрень вместо type
			}
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
		
		public function setIp($ip) {
			$this->ip = $ip;
		}
		
		public function setId($id) {
			if (is_numeric($id)) {
				$this->id = $id;
			} else {
				///ААА какая то хрень вместо id
			}
		}
	}
