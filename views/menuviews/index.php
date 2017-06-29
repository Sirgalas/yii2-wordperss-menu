<?php
use yii\widgets\Menu;
$content=json_decode($menu->$content);
$arrMenu= array();

foreach ($content->menus as $decode){
    if(isset($decode->menuItem)){
        $dropMenuAll= $model->Menu($decode->menuItem);
        $dropMenu=json_decode($dropMenuAll->content);
        $dropMenuArr=array();
        foreach ($dropMenu->menus as $jsonDecode){
            $dropMenuArr[]=['label'=>$jsonDecode->title,'url'=>'#'];
        }
        //var_dump($dropMenuArr);
        $arrMenu[]=['label'=>$dropMenuAll->name,'url'=>'#','items'=>$dropMenuArr];
    }else{
        $arrMenu[]=['label'=>$decode->title,'url'=>'#'];
    }


}
var_dump($arrMenu);
/*echo Menu::widget([
    'items' => [

        /*['label' => 'Главная', 'url' => ['site/index']],
        ['label' => 'О компании', 'url' => ['site/about']],
        ['label' => 'Услуги', 'url' => ['site/services']],
        ['label' => 'Контакты', 'url' => ['site/contacts']],
    ],
]);*/
 ?>