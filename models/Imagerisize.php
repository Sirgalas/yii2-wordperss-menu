<?php
namespace sirgalas\menu\models;


use yii\imagine\Image;
use yii\base\Model;
class Imagerisize extends Model
{
    public function imagerisize($uploadPath,$filenames,$module){
        $path = $uploadPath;
        $sizes= $module->imageResize;
        $count= 1;
        foreach ($sizes as $size){
            Image::thumbnail($path.'/'.$filenames, $size[0],$size[1])->save($path.'/'.$count.'-'.$filenames, ['quality' => 90]);
            $count++;
        }
        return true;
    }
}