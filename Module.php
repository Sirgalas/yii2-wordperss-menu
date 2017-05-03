<?php

namespace sirgalas\menu;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * transliter module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @var
     */
    public $model;


    /**
     * @inheritdoc
     */
    public function getAllModels(){
        if(isset($this->model)) {
           $model = $this->model['class'];
            return ArrayHelper::map($model::find()->asArray()->limit(50)->all(),$this->model['alias'],$this->model['title']);
        }
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
