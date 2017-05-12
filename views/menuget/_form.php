<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use sirgalas\menu\models\MenuGet;
use yii\web\View;
use sirgalas\menu\MenuAsset;
MenuAsset::register($this);
?>
<div class="frontend-setup-form col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
        <?php

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
        ActiveForm::end();?>
        <?php /*= $form->field($model, 'vaelye')->hiddenInput()->label(false); ?>
        <?= $form->field($model, 'description')->hiddenInput(['value'=>'menus'])->label(false);*/ ?>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
        <ul id="sortable">
            <?php  if(isset($value)){
                foreach ($value as $val){
                    if($val->cat == 1) {
                        foreach ($category as $cat) {
                            if ($val->id == $cat->id) {
                                echo "<li class='ui-state-default wells' data-id='$cat->id' data-cat='$val->cat' data-title='$cat->name'>$cat->name<span class='glyphicon glyphicon-remove del'></span></li>";
                            }
                        }
                    }else{
                        foreach ($pages as $page){
                            if ($val->id == $page->id) {
                                echo "<li class='ui-state-default wells' data-id='$page->id' data-cat='$val->cat' data-title='$page->title'>$page->title<span class='glyphicon glyphicon-remove del'></span></li>";
                            }
                        }
                    }
                }
            } ?>
        </ul>
        <a href="#" id="secure" class="btn btn-success col-lg-offset-8 col-md-offset-8 col-sm-offset-6">Закрепить меню</a>
    </div>
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php /*= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])*/ ?>
    </div>


    <div id="test"><div>
</div>

