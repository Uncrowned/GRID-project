<?php 
	include_once "Model.php";
	include_once "Node.php";
	
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
		
		public function changeNodeStatus($id, $status) {
			$sql = "UPDATE nodes SET status=:status WHERE id=:id";
			$arg = array(":id" => $id, ":status" => $status);
			$this->model->update($sql, $arg);
		}
		
		public function changeTaskStatus($id, $status) {
			$sql = "UPDATE tasks SET status=:status WHERE id=:id";
			$arg = array(":id" => $id, ":status" => $status);
			$this->model->update($sql, $arg);
		}
	}