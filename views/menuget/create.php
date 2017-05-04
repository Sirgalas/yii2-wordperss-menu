<?php
use sirgalas\menu\MenuAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

MenuAsset::register($this); ?>

<div class="frontend-setup-form col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <?php $form = ActiveForm::begin(); ?>
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
    <?= $form->field($model, 'key_setup')->textInput(['maxlength' => true])->label(Yii::t('backend','MENUTITLE')) ?>
    <?php echo $form->field($model, 'menus')->widget(Select2::classname(), [
        'data' => $cat,
        'language' => 'ru',
        'options' => ['placeholder' => Yii::t('backend','ADDMENUCAT')],
        'pluginOptions' => [
            'allowClear' => true
        ],

    ])->label('Категории');?>
    <a href="#" id="addCatMenu" class="btn btn-success" ><?= Yii::t('backend','ADDMENUCAT') ?></a>


    <?php if(is_array($page)){
        echo $form->field($model, 'pages')->widget(Select2::classname(), [
            'data' => $page,
            'language' => 'ru',
            'options' => ['placeholder' => Yii::t('backend','ADDMENUPAGE')],
            'pluginOptions' => [
                'allowClear' => true
            ],

        ])->label('Страницы');
    }?>
    <a href="#" id="addPageMenu" class="btn btn-success" ><?= Yii::t('backend','ADDMENUPAGE') ?></a>
    <?= $form->field($model, 'vaelye')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'description')->hiddenInput(['value'=>'menus'])->label(false); ?>
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
    <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
