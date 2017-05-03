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
    public $models;

    /**
     * @inheritdoc
     */
    public function getAllModels(){
        if(isset($this->model)) {
           $model = ArrayHelper::map($this->model['class']::find()->asArray()->limit(50)->all(),$this->model['alias'],$this->model['title']);;
        }
        if(isset($this->models)){
            $counter=0;
            foreach ($this->models as $models){
                $model[$counter]=ArrayHelper::map($models['class']::find()->asArray()->limit(50)->all(),$models['alias'],$models['title']);
            $counter++;
            }
        }
        return $model;
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
