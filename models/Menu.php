<?php


namespace sirgalas\menu\models;


use yii\db\ActiveRecord;
use sirgalas\menu\MenuModule;
class Menu extends ActiveRecord
{

    public $imageFile;
    public static function tableName()
    {
            return '{{%menu_table}}';
    }

    public function rules()
    {
            return [
                [['name', 'content'], 'required'],
                [['content'], 'string'],
                [['name'], 'string', 'max' => 510],
                [['name'], 'unique'],
                [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            ];

    }
    public function attributeLabels()
    {
        $returnArray=array([
            'id' => 'id',
            'name' => MenuModule::t('translit','Name'),
            'content'    => MenuModule::t('translit','Content'),
        ]);

        return $returnArray;
    }
    public function Menu($menu){
        $munuItem=Menu::findOne($menu);
        return $munuItem;
    }
}