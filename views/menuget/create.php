<?php
use yii\helpers\Html;
use yii\web\View;
use sirgalas\menu\Module;
use yii\widgets\ActiveForm;
?>
<div class="menu-create patern">
    <h1><?= Module::t('translit','Create menu') ?></h1>
    <div class="frontend-setup-form col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <?= $this->render('_form', [ 'model'=>$model,'module'=>$module]) ?>
            <?php
            foreach($module->models as $key => $value) {}
            ?>
            <div class="dropFileHide">
            </div>
        </div>
        <?php
        if(isset($module->extra_menu)){ ?>
        <div class="col-lg-9 col-md-9 col-sm-6 col-xs-6">
            <?php
            if(empty($module->modelDb)) {
                $name = 'name';
                $content = 'content';
            }else{
                $name = $module->modelDb["name"];
                $content = $module->modelDb["content"];
            }    
            $form = ActiveForm::begin(['id'=>'formMenu']); ?>
                <?= $form->field($model,$name)->textInput(['class'=>'name'])->label(Module::t('translit','enterNameMenu')) ?>
                <ul id="menu-to-edit" class="sortable-ui connectedSortables" data-class="menu">
                </ul>
                 <?php
                    for($i=$module->extra_menu;$i>0;$i--){
                        echo "<ul class=\"sortable-ui extra connectedSortables \" data-class=\"extra-".$i."\"></ul>";
                    }
                 }else{ ?>
                     <ul id="menu-to-edit" class="sortable-ui col-lg-12 col-md-12 col-sm-12 col-xs-12"  data-class="menu">
                     </ul>
                 <?php } ?>
                <?= $form->field($model,$content)->hiddenInput(['id'=>'contentForJson'])->label(false); ?>
            <?php ActiveForm::end(); ?>
            <a href="#" id="secures" class="btn btn-success col-lg-offset-8 col-md-offset-8 col-sm-offset-6"><?= Module::t('translit','Save'); ?></a>
        </div>
        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php /*= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])*/ ?>
        </div>
    </div>
</div>