<?php
use yii\widgets\Menu;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
$contents=json_decode($menu->$content);
$arrMenu= array();
if(isset($home)){
    $arrMenu[] = ['label' => $home,'url' => [Yii::$app->homeUrl]];
}
foreach ($contents->menus as $decode) {
    if (isset($decode->menuItem)) {
        $dropMenuAll = $modelMenu->Menu($decode->menuItem);
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



if($navWidget=='menu'){
    echo Menu::widget([
        'items'             =>  $arrMenu,
        'labelTemplate'     =>  $labelTemplate,
        'linkTemplate'      =>  $linkTemplate,
        'options'           =>  $navBarOption,
        'encodeLabels'      =>  $encodeLabels,
        'activeCssClass'    =>  $activeCssClass,
        'firstItemCssClass' =>  $firstItemCssClass,
        'lastItemCssClass'  =>  $lastItemCssClass,
    ]);
}
if($navWidget=='navbar'){
    NavBar::begin([
        'brandLabel'        =>  $brandLabel,
        'brandUrl'          =>  $brandUrl,
        'options'           =>  $navBarOption,
        'containerOptions'  =>  $containerOptions,
    ]);
    echo Nav::widget([
        'options'   =>  $navOption,
        'items'     =>  $arrMenu,
    ]);
    NavBar::end();
}

 ?>