<?php
use yii\widgets\Menu;
$contents=json_decode($menu->$content);
$arrMenu= array();
foreach ($contents->menus as $decode) {
    if (isset($decode->menuItem)) {
        $dropMenuAll = $modelMenu->Menu($decode->menuItem);
        $dropMenu = json_decode($dropMenuAll->$content);
        $dropMenuArr = array();
        foreach ($dropMenu->menus as $jsonDecode) {
            $dropMenuArr[] = ['label' => $jsonDecode->title, 'url' => [$jsonDecode->path,$nameAlias=>$jsonDecode->alias]];
        }
        $arrMenu[] = ['label' => $decode->text, 'url' => '#', 'items' => $dropMenuArr];
    } else {
        $arrMenu[] = ['label' => $decode->title,'url' => [$decode->path,$nameAlias=>$decode->alias]];
    }
}

echo Menu::widget([
    'items' =>
        $arrMenu
]);
 ?>