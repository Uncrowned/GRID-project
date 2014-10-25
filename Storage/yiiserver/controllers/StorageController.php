<?php

namespace app\controllers;

use app\models\Files;
use app\models\Storage;

class StorageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->deleteNotActiveNode();
        if (isset($_GET['id'])) {
            if ($_GET['id'] == 0) {
                $model = new Storage();
                $model->setAttribute('time', time());
                if ($model->save()) {
                    $model = Storage::find()->where(['time' => $model->time])->one();
                    return $this->renderPartial('index',
                        [
                            'id' => $model->node_id,
                        ]);
                } else {
                    return $this->render('error');
                }

            } else {
                $model = Storage::find($_GET['id']);
                if ($model = $model->where(['node_id' => $_GET['id']])->one()) {
                    $model->setAttribute("time", time());
                    if ($model->save()) {
                        return $this->renderPartial('index',
                            [
                                'id' => $model->node_id,
                            ]);
                    } else {
                        return $this->render('error');
                    }
                }
            }
        }
    }

    public function actionStorage()
    {
        if (!empty($_POST)) {
            $f = fopen("temp/" . $_POST['filename'], "w");
            fwrite($f, $_POST['file']);
            fclose($f);

            $model = new Files();
            $model->name_file = $_POST['filename'];
            $model->download = 0;
            $model->hash = md5_file("temp/" . $_POST['filename']);
            $model->count = count(Storage::find()->all());
            if(!$model->save())
            {
                echo "не сохранилось в базу";
                return 0;
            }

            $f = fopen("temp/" . $_POST['filename'], "rb");
            $length = filesize("temp/" . $_POST['filename']);

            $dx = $length/count(Storage::find()->all());;
            for ($i = 0; $i < ($length/$dx)-1; ) {
                fseek($f, $i * $dx);
                $bytes = fread($f, $dx);
                $fw = fopen("temp/" . $_POST['filename'] . $i, 'wb');
                fwrite($fw, $bytes);
                fclose($fw);
                $i++;
            }
            fseek($f, $i * $dx);
            $bytes = fread($f, $length-$i*$dx+1);
            $fw = fopen("temp\\" . $_POST['filename'] . $i, 'wb');
            fwrite($fw, $bytes);
            fclose($fw);

        } else {
            echo "не было поста";
        }
    }

    public function deleteNotActiveNode()
    {
        $model = Storage::find()->all();
        foreach ($model as $node) {
            if (time() - $node->time >= 23) {
                $node->delete();
            }
        }
    }
}
