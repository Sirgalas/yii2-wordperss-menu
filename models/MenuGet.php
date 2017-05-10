<?php

namespace sirgalas\menu\models;
use kartik\select2\Select2;


class MenuGet extends Menu
{
    public function addSelect($models){
        $diff = count($models) - count($models, COUNT_RECURSIVE);
        if($diff){
            foreach ($models as $model){
                $select=Select2::widget([
                    'name' => 'state_2',
                    'value' => '',
                    'data' => $model,
                    'options' => ['placeholder' => 'Select states ...'],
                    'pluginEvents' => [
                        "select2:selecting" => "function(e) { 
                         alert(e);
                        var id = document.getElementById('test'); 
                        id.innerHTML='e';
                        }",
                        "select2:select" => "function(e) { 
                        
                            var id = document.getElementById('test'); 
                            
                            id.innerHTML=e;
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