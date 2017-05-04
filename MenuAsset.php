<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 04.05.17
 * Time: 15:34
 */

namespace sirgalas\menu;
use yii\web\AssetBundle;

class MenuAsset extends AssetBundle
{
    public $basePath =__DIR__ . '/assets';
    public $baseUrl=__DIR__ . '/assets';
    public $css = [
        'css/style.css',    
    ];
    public $js=[
        'js/script',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\jui\JuiAsset',
    ];
}