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
		fwrite($f,"�� ���� �����!!");
		fclose($f);
	}
?>