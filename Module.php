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
    public $label;
    public $controllerNamespace = 'sirgalas\menu\controllers';
    /**
     * @inheritdoc
     */
    public function getAllModels(){
        if(isset($this->model)) {
            if(isset($models['label'])){
                $label=$this->model['label'];
            }else{
                $label='выбрать '.$this->model['class'];
            }
           $model[$label] = ArrayHelper::map($this->model['class']::find()->asArray()->all(),$this->model['alias'],$this->model['title']);;
        }
        if(isset($this->models)){
            foreach ($this->models as $models){
                if(isset($models['label'])){
                    $label=$models['label'];
                }else{
                    $label='выбрать '.$models['class'];
                }
                $model[$label]=ArrayHelper::map($models['class']::find()->asArray()->all(),$models['alias'],$models['title']);
            }
        }
        return $model;
    }

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    /**
     * @inheritdoc
     */
   
}
