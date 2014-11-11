<?php
	
	class Config {
		
		public static $dbCfg = array("host" => "localhost", "userName" => "root", 
            "password" => "", "dbName" => "grid_server", "prefix" => "");
		
		public static $statusNode = array("free", "busy", "dead");
		
		public static $typeNode = array("calculator", "storage");
		
		public static $statusTask = array("available", "underway", "done");
		
		
	}
