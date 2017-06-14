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
        <div class="col-lg-9 col-md-9 col-sm-6 col-xs-6">
            <?php
            if(empty($module->modelDb)) {
                $name = 'name';
                $content = 'content';
            }else{
                $name = $module->modelDb["name"];
                $content = $module->modelDb["content"];
            }
        $form = ActiveForm::begin(['id'=>'formMenu']);
            echo $form->field($model,$name)->textInput(['class'=>'name'])->label(Module::t('translit','enterNameMenu')) ?>
            <ul id="menu-to-edit" class="sortable-ui connectedSortables" data-class="menus" data-name="MenuGet[<?= $content ?>]"></ul>
             <?php if(isset($module->extra_menu)){
                     for($i=$module->extra_menu;$i>0;$i--){
                        echo "<ul class=\"sortable-ui extra connectedSortables \" data-class=\"extra-".$i."\"></ul>";
                    }
                 } ?>
            <div class="form-group">
                <?= Html::submitButton(Module::t('translit','Save'), ['class' => 'btn btn-success', 'id' => 'secures','data-formurl'=>Yii::$app->urlManager->createUrl(['/menu/menuget'])]); ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php /*= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])*/ ?>
        </div>
    </div>
</div>