<?php


namespace sirgalas\menu\models;

use Yii;
use yii\db\ActiveRecord;
use sirgalas\menu\MenuModule;
use sirgalas\menu\behaviors\MenuBaseWordpressBehavior;
class Menu extends ActiveRecord
{

    public $imageFile;
    public static function tableName()
    {
        if(isset(Yii::$app->modules['menu']->modelDb)){
            $menuModel=Yii::$app->modules['menu']->modelDb;
            $menuSetup=new $menuModel;
            return $menuSetup->getDbName();
        }else{
            return '{{%menu_table}}';
        }

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

            $returnArray = array([
                'id' => 'id',
                'name' => MenuModule::t('translit', 'Name'),
                'content' => MenuModule::t('translit', 'Content'),
            ]);

        return $returnArray;
    }
    public function Menu($menu){
        if(isset(Yii::$app->modules['menu']->modelDb)) {
            $menuModel = Yii::$app->modules['menu']->modelDb;
            $menuSetup = $menuModel::findOne($menu);
        }else{
            $munuItem=Menu::findOne($menu);
        }
        return $munuItem;
    }
}