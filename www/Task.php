<?php 	
	//ýòî äîëæíî áûòü èíòåðôåéñîì
	class Task {
	
		//public $fields = array();
		public function __construct($task) {
			$this->id = $task["id"];
			$this->status = $task["status"];
			$this->date_born = $task["date_born"];
			$this->data = $task["data"];
			$this->instructions = $task["instructions"];
			$this->type = $task["type"];
		}
		
		protected $id;
		
		protected $status;
		
		protected $date_born;
		
		protected $data;
		
		protected $instructions;
		
		protected $type;
	}
