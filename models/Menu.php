<?php


namespace sirgalas\menu\models;


use yii\db\ActiveRecord;
use sirgalas\menu\Module;
class Menu extends ActiveRecord
{

    public static function tableName()
    {
        $module=self::module;
        if(empty($module->modelDb)){
            return '{{%menu_table}}';
        }else{
            return $module->dbName->name;
        }
    }

    public function rules()
    {
        $module=self::module;
        if(empty($module->modelDb)) {
            return [
                [['name', 'content'], 'required'],
                [['content'], 'string'],
                [['name'], 'string', 'max' => 510],
                [['name'], 'unique'],
            ];
        }else{
            return [
                [[$module->dbName->name, $module->content], 'required'],
                [[$module->dbName->content], 'string'],
                [[$module->dbName->name,$module->serviceField], 'string', 'max' => 510],
                [[$module->dbName->name], 'unique'],
            ];
        }
    }
    public function attributeLabels()
    {
        $module=self::module;
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