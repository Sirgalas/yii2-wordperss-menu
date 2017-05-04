<?php

namespace sirgalas\menu\models;
use kartik\select2\Select2;


class MenuGet extends Menu
{
    public function addSelect($model){
        $diff = count($model) - count($model, COUNT_RECURSIVE);
        if($diff){
            
        }else{
            $select = Select2::widget([
                'name' => 'state_2',
                'value' => '',
                'data' => $model,
                'options' => ['multiple' => true, 'placeholder' => 'Select states ...']
            ]);
        }
    }
}