<?php 
	include_once "Model.php";
	
	class GridModel extends Model{
		
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
			$node->setIp($result["ip"]);
			$node->setId($result["id"]);
			
			return $node;
		}
	}