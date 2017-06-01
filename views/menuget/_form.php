<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use sirgalas\menu\models\MenuGet;
use yii\web\View;
use sirgalas\menu\MenuAsset;
use kartik\select2\Select2;
use yii\helpers\Url;
MenuAsset::register($this);
?>
    <?php 
        $form = ActiveForm::begin();
            $menu=new MenuGet();
                foreach ($module->models as $modul){
                    if(isset($modul['label'])){
                        $label=$modul['label'];
                    }else{
                        $label=$modul['class'];
                    } ?>
                    <div class="form-group field-menu" >
                        <?= Html::hiddenInput('path',$modul['path'],['id'=>'paht_'.$modul['alias']]); ?>
                    </div>
                    <div class="form-group field-menu" >
                        <?= Html::hiddenInput('class',$modul['class'],['id'=>'class_'.$modul['alias']]); ?>
                    </div>
                    <div class="form-group field-menu" >
                        <?= Html::hiddenInput('alias',$modul['alias'],['id'=>'alias_'.$modul['alias']]); ?>
                    </div>
                    <?php echo '<div class="form-group field-menu">';
                    //var class= alias.parentNode.previousElementSibling.childNodes[0];
                        $selectArr=$model->addSelect($modul);
                      echo Select2::widget([
                         'name' => 'state_2',
                         'value' => '',
                         'data' => $selectArr,
                         'options' => ['placeholder' => $label],
                         'pluginEvents' => [
                             "select2:selecting" => "function(e) {
                            var print = log(e);
                            var alias=e.target.parentNode.previousElementSibling.childNodes[1];
                            var model= alias.parentNode.previousElementSibling.childNodes[1];
                            var path = model.parentNode.previousElementSibling.childNodes[1];
                            var sortable = document.getElementById('menu-to-edit');
                            var value = sortable.innerHTML
                            var text = print.args.data.text;
                            var id = print.args.data.id;
                            var input = '<li class=\"ui-state-default wells\" data-path=\"'+path.value+'\" data-model=\"'+model.value+'\"  data-alias=\"'+alias.value+'\" data-title=\"'+text+'\" data-depth=\"0\" data-id=\"'+id+'\"  data-item=\"'+count+'\" >'+text+'<span class= \"glyphicon glyphicon-remove del\"></span> <span class=\"glyphicon glyphicon-chevron-down showInput\"></span><p class=\"form-group hide\"><label>title <input type=\"text\" class=\"form-control\" placeholder=\"Enter title\" /></label><br/>".Html::a('Download image','#', ['data-url'=>Url::to(["/menu/menuget/create"]), 'class'=>'showDropFile'])."</p></li>';
                            sortable.innerHTML=value +''+ input;
                            count++;
                        }",
                             "select2:select" => "function(e) {

                         }"
                         ]
                     ]); 

                    echo '</div>';
                }

        ActiveForm::end();
    ?>

   

