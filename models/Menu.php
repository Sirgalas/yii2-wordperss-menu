<?php


namespace sirgalas\menu\models;


use yii\db\ActiveRecord;
use sirgalas\menu\MenuModule;
class Menu extends ActiveRecord
{

    public $imageFile;
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
                [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            ];
        }else{
            return [
                [[$module->modelDb["name"], $module->modelDb["content"]], 'required'],
                [[$module->modelDb["content"]], 'string'],
                [[$module->modelDb["name"],$module->modelDb["serviceField"]], 'string', 'max' => 510],
                [[$module->modelDb["name"]], 'unique'],
                //[['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            ];
        }
    }
    public function attributeLabels()
    {
        $module = \Yii::$app->controller->module;
        $returnArray=array([
            'id' => 'id',
            'name' => MenuModule::t('translit','Name'),
            'content'    => MenuModule::t('translit','Content'),
        ]);
        if(!empty($module->modelDb)){
            $returnArray['serviceField']=MenuModule::t('translit','Service-Feild');
        }
        return $returnArray;
    }
}