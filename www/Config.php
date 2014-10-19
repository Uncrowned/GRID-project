<?php
	
	class Config {
		
		public static $dbCfg = array("host" => "localhost", "userName" => "root", 
            "password" => "", "dbName" => "grid_server", "prefix" => "");
		
		public static $statusNode = array("free" => 0, "busy" => 1, "dead" => 2);
		
		public static $typeNode = array("calculator" => 0, "storage" => 1);
	}
