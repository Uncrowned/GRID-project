<?php
	if(!empty($_POST))
	{
		$f = fopen("test.txt","w");
		fwrite($f,var_export($_POST, true));
		fclose($f);
	}
	else
	{
		$f = fopen("test.txt","w");
		fwrite($f,"Не было поста!!");
		fclose($f);
	}
?>