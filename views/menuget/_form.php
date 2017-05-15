<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use sirgalas\menu\models\MenuGet;
use yii\web\View;
use sirgalas\menu\MenuAsset;
MenuAsset::register($this);
?>
    <?php 
        $form = ActiveForm::begin(); 
            $menu=new MenuGet();
            $select=$menu->addSelect($allModels);
           if(is_array($select)){
                foreach ($select as $sel){
                    echo '<div class="form-group field-menu">';
                    echo $sel;
                    echo '</div>';
                }
            }else{
                echo $select;
            }
        ActiveForm::end();
    ?>

   

