<?php


namespace sirgalas\menu\models;


use yii\db\ActiveRecord;
use sirgalas\menu\Module;
class Menu extends ActiveRecord
{

    public static function tableName()
    {
        $module=self::modules;
        if(empty($module->modelDb)){
            return '{{%menu_table}}';
        }else{
            return $module->dbName;
        }
    }

    public function rules()
    {
        $module=self::modules;
        if(empty($module->modelDb)) {
            return [
                [['name', 'content'], 'required'],
                [['content'], 'string'],
                [['name'], 'string', 'max' => 510],
                [['name'], 'unique'],
            ];
        }else{
            return [
                [[$module->name, $module->content], 'required'],
                [[$module->content], 'string'],
                [[$module->name,$module->serviceField], 'string', 'max' => 510],
                [[$module->name], 'unique'],
            ];
        }
    }
    public function attributeLabels()
    {
        $module=self::modules;
        $returnArray=array([
            'id' => 'id',
            'name' => Module::t('Name'),
            'content'    => Module::t('Content'),
        ]);
        if(!empty($module->modelDb)){
            $returnArray['serviceField']=Module::t('Service-Feild');
        }
        return $returnArray;
    }
}