<?php


namespace sirgalas\menu\models;


use yii\db\ActiveRecord;
use sirgalas\menu\Module;
class Menu extends ActiveRecord
{

    public static function tableName()
    {
        $module = \Yii::$app->controller->module;
        if(empty($module->modelDb)){
            return '{{%menu_table}}';
        }else{
            return $module->modelDb['dbName'];
        }
    }

    public function rules()
    {
        $module = \Yii::$app->controller->module;
        if(empty($module->modelDb)) {
            return [
                [['name', 'content'], 'required'],
                [['content'], 'string'],
                [['name'], 'string', 'max' => 510],
                [['name'], 'unique'],
            ];
        }else{
            return [
                [[$module->modelDb["name"], $module->modelDb["content"]], 'required'],
                [[$module->modelDb["content"]], 'string'],
                [[$module->modelDb["name"],$module->modelDb["serviceField"]], 'string', 'max' => 510],
                [[$module->modelDb["name"]], 'unique'],
            ];
        }
    }
    public function attributeLabels()
    {
        $module = \Yii::$app->controller->module;
        $returnArray=array([
            'id' => 'id',
            'name' => Module::t('translit','Name'),
            'content'    => Module::t('translit','Content'),
        ]);
        if(!empty($module->modelDb)){
            $returnArray['serviceField']=Module::t('translit','Service-Feild');
        }
        return $returnArray;
    }
}