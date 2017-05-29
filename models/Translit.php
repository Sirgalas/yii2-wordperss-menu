<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 29.05.17
 * Time: 14:55
 */

namespace sirgalas\menu\models;

use yii\base\Model;
use dosamigos\transliterator\TransliteratorHelper;

class Translit extends Model{
    public function traranslitImg($img){
        $strArr = array('/', '\\', ',', '<', '>', '"', "ь", "ъ",' ',);
        $slugimmage = str_replace($strArr, '', $img);
        $slugimg = str_replace(' ', '', $slugimmage);
        $filenames=TransliteratorHelper::process($slugimg, '', 'en');
        return $filenames;
    }

}