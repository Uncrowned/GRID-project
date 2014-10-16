<?php
header('Content-Type: text/html; charset=utf-8');
if (!empty($_POST))
{
    $f = fopen("temp/" . $_POST['filename'], "w");
    fwrite($f, $_POST['file']);
    fclose($f);
    //тут еще хэш надо посчитать и в базу записать, чтоб потом сравнивать все ли мы с скачали

    $f = fopen("temp/" . $_POST['filename'], "rb");
    $length = filesize("temp/" . $_POST['filename']);
    //тут типо должно получать сколько нод есть и делать шаг который я 
	//пока что ставлю случайным образом. вместо 50 нарисовать количество нод
    for ($i = 0; $i < $length / 50; $i++) {
        fseek($f, $i * 50);
        $bytes = fread($f, 50);
        $fw = fopen("temp/" . $_POST['filename'] . $i, 'wb');
        fwrite($fw, $bytes);
        fclose($fw);
    }
}
else
{
    echo "Не было поста!!";
}


    
