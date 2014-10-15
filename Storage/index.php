<?php
	if(!empty($_POST))
    {
        $f = fopen("temp/".$_POST['filename'],"w");
        fwrite($f, $_POST['file']);
        fclose($f);
        echo "файл принят";
	}
	else
	{
		$f = fopen("test.txt","w");
		fwrite($f,"Не было поста!!");
		fclose($f);
	}
