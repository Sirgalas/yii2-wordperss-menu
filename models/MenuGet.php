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
                            var test = document.getElementById('test');
                            var text = print.args.data.text;
                            var alias = print.args.data.id;
                            test.innerHTML=alias
                        }",
                        "select2:select" => "function(e) { 
                            console.log('e');
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