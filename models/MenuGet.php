<?php

namespace sirgalas\menu\models;
use yii\helpers\ArrayHelper;


class MenuGet extends Menu
{
    public function addSelect($models){
        return ArrayHelper::map($models['class']::find()->asArray()->all(),$models['id'],$models['title']);
    }
    
    public function addSelectMenu($modules){
        if($modules->modelDb){
            $nameModel=$modules->modelDb['nameModel'];
            return ArrayHelper::map($nameModel::find()->asArray()->all(),$modules->modelDb['id'],$modules->modelDb['name']);
        }else{
            return ArrayHelper::map(Menu::find()->asArray()->all(),'id','name');
        }
    }
}