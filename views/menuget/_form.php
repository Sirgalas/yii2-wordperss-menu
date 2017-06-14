<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use sirgalas\menu\models\MenuGet;
use yii\web\View;
use sirgalas\menu\MenuAsset;
use kartik\select2\Select2;
use yii\helpers\Url;
use sirgalas\menu\Module;
MenuAsset::register($this);
$menu=new MenuGet();
?>
    <?php 
        $form = ActiveForm::begin();
                foreach ($module->models as $modul){
                    if(isset($modul['label'])){
                        $label=$modul['label'];
                    }else{
                        $label=$modul['class'];
                    } ?>
                    <?php echo '<div class="form-group field-menu" id="theSelectTwo" data-path="'.$modul['path'].'" data-class="'.$modul['class'].'" data-alias="'.$modul['alias'].'"">';

                        $selectArr=$model->addSelect($modul);
                    if(isset($module->imageSetPath)&&isset($module->imageResize)){
                        $url=Html::a(Module::t('translit','Download image'),'#', ['data-url'=>Url::to(["/menu/menuget/create"]), 'class'=>'showDropFile']);
                    }else{
                        $url='';
                    }
                      echo Select2::widget([
                         'name' => 'state_2',
                         'value' => '',
                         'data' => $selectArr,
                         'options' => ['placeholder' => $label],
                         'pluginEvents' => [
                             "select2:selecting" => "function(e) {
                                var print = log(e);
                                var parent = $('#theSelectTwo');
                                var alias=parent.data('alias');
                                var model= parent.data('class');
                                var path = parent.data('path');
                                var sortable = $('#menu-to-edit');
                                var value = sortable.html();
                                var text = print.args.data.text;
                                var id = print.args.data.id;
                                var input = '<li class=\"ui-state-default wells\" data-path=\"'+path+'\" id=\"menu-'+count+'\" data-model=\"'+model+'\"  data-alias=\"'+alias+'\" data-title=\''+text+'\' data-depth=\"0\" data-id=\"'+id+'\"  data-item=\"'+count+'\" >'+text+'<span class= \"glyphicon glyphicon-remove del\"></span> <span class=\"glyphicon glyphicon-chevron-down showInput\"></span><p class=\"form-group hide\"><label>".Module::t('translit','title')."<input type=\"text\"  class=\"form-control tilteInput\" placeholder=\"".Module::t('translit','Enter title').".\" /></label></p><p class=\"form-group hide\"><label>".Module::t('translit','class')."<input type=\"text\"  class=\"form-control classInput\" placeholder=\"".Module::t('translit','Enter class')."\" /></label></p><p class=\"form-group hide\"><label>".Module::t('translit','id')."<input type=\"text\" class=\"form-control idInput\" placeholder=\"".Module::t('translit','Enter id')."\" /></label></p><p class=\"form-group hide\">".$url."</p></li>';
                                $('.dropFileHide').hide();
                                theInnerHtml=value +''+ input;
                                sortable.html(theInnerHtml);
                                count++; }"
                         ]
                     ]); 

                    echo '</div>';
                }
            echo '<div class="form-group field-menu">';
            $selectMenu=$model->addSelectMenu($module);
            echo Select2::widget([
                'name' => 'state_2',
                'value' => '',
                'data' => $selectMenu,
                'options' => ['placeholder' => Module::t('translit','menuSelect')],
                'pluginEvents' => [
                "select2:selecting" => "function(e) {
                    var print = log(e);
                    var id = print.args.data.id;
                    var text = print.args.data.text;
                    var input = '<li class=\"ui-state-default wells\"  data-menu=\"'+id+'\"  data-depth=\"0\"  data-item=\"'+count+'\" >'+text+'<span class= \"glyphicon glyphicon-remove del\"></span> <span class=\"glyphicon glyphicon-chevron-down showInput\"></span><p class=\"form-group hide\"><label>title ".Module::t('translit','title')."<input type=\"text\"  class=\"form-control tilteInput\" placeholder=\"".Module::t('translit','Enter title').".\" /></label></p><p class=\"form-group hide\"><label>".Module::t('translit','class')."<input type=\"text\"  class=\"form-control classInput\" placeholder=\"".Module::t('translit','Enter class')."\" /></label></p><p class=\"form-group hide\"><label>".Module::t('translit','id')."<input type=\"text\" class=\"form-control idInput\" placeholder=\"".Module::t('translit','Enter id')."\" /></label></p></li>';
                    count++;
                    $('.dropFileHide').hide();
                    var sortable = document.getElementById('menu-to-edit');
                    var value = sortable.innerHTML
                    sortable.innerHTML=value +''+ input;
                }"
                ]
            ]);
            echo '</div>';
        ActiveForm::end();
    ?>

   

