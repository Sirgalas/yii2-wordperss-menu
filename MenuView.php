<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.06.17
 * Time: 21:50
 */

namespace sirgalas\menu;


use sirgalas\menu\models\Menu;
use sirgalas\menu\models\MenuViews;
use yii\base\Widget;

use Yii;
class MenuView extends Widget
{
    public $name;
    public function init(){
        parent::init();
    }
    public function run(){
        if(isset(Yii::$app->modules["menu"]["modelDb"])) {
            $menuModel = Yii::$app->modules["menu"]["modelDb"];
            $model=new $menuModel;
            $menu=$menuModel::find()->where([$model->getName()=>$this->name])->one();
            $content=$model->getContent();
        }else{
            $menu=Menu::find()->where(['name'=>$this->name])->one();
            $content='content';
        }

        $model= new Menu();
        
        return $this->render('menuviews/index',[
            'menu'      =>  $menu,
            'model'     =>  $model,
            'content'   =>  $content
        ]);
    }

}