<?php

namespace sirgalas\menu\models;
use yii\helpers\ArrayHelper;


class MenuGet extends Menu
{
    public function addSelect($models){
        return ArrayHelper::map($models['class']::find()->asArray()->all(),$models['id'],$models['title']);
    }
}