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
        if(isset(Yii::$app->modules['menu']['modelDb'])) {
            $menuModel = Yii::$app->modules['menu']['modelDb'];
            $munuItem = $menuModel::findOne($menu);
        }else{
            $munuItem=Menu::findOne($menu);
        }
        return $munuItem;
    }

    public function renderMenu($menu,$content,$nameAlias){
        $contents=json_decode($menu->$content);
        foreach ($contents->menus as $decode) {
            if (isset($decode->menuItem)) {
                $dropMenuAll = $this->Menu($decode->menuItem);
                $dropMenu = json_decode($dropMenuAll->$content);
                $dropMenuArr = array();
                $objectVars = get_object_vars($dropMenu);
                foreach ($objectVars as $key => $value) {
                    if (strpos($key,'extra') ===0) {
                        foreach ($value as $jsonDecode) {
                            $dropMenuArr[] = ['label' => $jsonDecode->title, 'url' => [$jsonDecode->path, $nameAlias => $jsonDecode->alias, 'option' => ['class' => 'extra']]];
                        }
                    }else{
                        foreach ($value as $jsonDecode) {
                            $dropMenuArr[] = ['label' => $jsonDecode->title, 'url' => [$jsonDecode->path,$nameAlias=>$jsonDecode->alias]];
                        }
                    }
                }
                $arrMenu[] = ['label' => $decode->text, 'url' => '', 'items' => $dropMenuArr, 'linkOptions'=>['data-toggle'=>'not']];
            } else {
                $arrMenu[] = ['label' => $decode->title,'url' => [$decode->path,$nameAlias=>$decode->alias]];
            }
        }
        return var_dump($arrMenu);
    }
}