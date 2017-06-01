<?php
namespace sirgalas\menu\models;

use sirgalas\menu\Module;
use yii\imagine\Image;
use yii\base\Model;
class Imagerisize extends Model
{
    public function imagerisize($uploadPath,$filenames,$model){
        $path = $uploadPath;
        $img = Image::getImagine()->open($path . '' . $filenames);
        $size = $img->getSize();
        $ratio = $size->getWidth() / $size->getHeight();
        $height = round( 530 / $ratio);
        Image::thumbnail($path . '/' . $model->name, 292,$height)->save($path . 'fancy-' . $model->name, ['quality' => 90]);
        return true;
    }
}