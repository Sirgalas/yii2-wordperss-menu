<?php

namespace sirgalas\menu;
use Yii;

/**
 * transliter module definition class
 */
class Module extends \yii\base\Module
{

    public $model;
    /**
     * @inheritdoc
     */
    public function getAllModels(){
        $model = $this->model;
        return $model::find()->limit(50)->all();
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
