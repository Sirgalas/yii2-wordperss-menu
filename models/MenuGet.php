<?php

namespace sirgalas\menu\models;
use kartik\select2\Select2;


class MenuGet extends Menu
{
    public function addSelect($models){
       $diff = count($models) - count($models, COUNT_RECURSIVE);
        if($diff){
            foreach ($models as $key => $model){
                $select[]=Select2::widget([
                    'name' => 'state_2',
                    'value' => '',
                    'data' => $model,
                    'options' => ['placeholder' => $key],
                    'pluginEvents' => [
                        "select2:selecting" => "function(e) { 
                            var print = log(e);
                            var sortable = document.getElementById('menu-to-edit');
                            var value = sortable.innerHTML
                            var text = print.args.data.text;
                            var alias = print.args.data.id;
                            var input = '<li class=\"ui-state-default wells\"  data-alias=\"'+alias+'\" data-title=\"'+text+'\" data-depth=\"0\">'+text+'<span class= \"glyphicon glyphicon-remove del\"></span></li>';
                            sortable.innerHTML=value +''+ input;
                        }",
                        "select2:select" => "function(e) { 
                            
                         }"
                    ]
                ]);
            }
        }else{
            $select = Select2::widget([
                'name' => 'state_2',
                'value' => '',
                'data' => $models,
                'options' => ['multiple' => true, 'placeholder' => 'Select states ...']
            ]);
           
        }
        return $select;
    }
}