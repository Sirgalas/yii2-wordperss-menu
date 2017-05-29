<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 29.05.17
 * Time: 14:50
 */

namespace sirgalas\menu\models;


use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use backend\models\Translit;
class UploadImage extends Model
{
    public $files;
    public function rules()
    {
        return [
            [['files'], 'file','skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],
        ];
    }
    public function upload($path,$files_to,$fileName){
        $transliterator=new Translit();
        $file = \yii\web\UploadedFile::getInstanceByName($fileName);
        $filenames=$transliterator->traranslitImg($file);
        if ($this->validate()) {
            if (file_exists(Yii::getAlias('@frontend/web/image/').$path)) {
            } else {
                mkdir(Yii::getAlias('@frontend/web/image/').$path, 0775, true);
            }
            $this->files->saveAs(Yii::getAlias('@frontend/web/image/').$path.''.$files_to);
            return true;
        } else {
            return var_dump($this->getErrors());
        }
    }
}