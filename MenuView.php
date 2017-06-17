<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.06.17
 * Time: 21:50
 */

namespace sirgalas\menu;


use sirgalas\menu\models\Menu;
use yii\base\Widget;
use sirgalas\menu\MenuModule;
class MenuView extends Widget
{
    public $name;
    public function init(){
        parent::init();
    }
    public function run(){
        $model=Menu::findOne($this->name);
        $module= MenuModule::getInstance();
        return $this->render('menuviews/index',[
            'module'=>$module
        ]);
    }

}