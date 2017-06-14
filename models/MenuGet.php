<?php

namespace sirgalas\menu\models;
use yii\helpers\ArrayHelper;
use sirgalas\menu\Module;
use yii\helpers\Html;
use yii\helpers\Url;


class MenuGet extends Menu
{
    public function addSelect($models){
        return ArrayHelper::map($models['class']::find()->asArray()->all(),$models['id'],$models['title']);
    }
    
    public function addSelectMenu($modules){
        if($modules->modelDb){
            $nameModel=$modules->modelDb['nameModel'];
            return ArrayHelper::map($nameModel::find()->asArray()->all(),$modules->modelDb['id'],$modules->modelDb['name']);
        }else{
            return ArrayHelper::map(Menu::find()->asArray()->all(),'id','name');
        }
    }

    public function getMenu($json,$module,$name){
        if(isset($json->$name)){
            $str='';
            $count=0;
            $idStr=substr(key($json->$name),0,-1);
            foreach ($json->$name as $menu){

                if(isset($menu->imgPath)){
                    $img =Html::img($menu->imgPath.'/'.$menu->imgName);
                }else{
                    $img='';
                }
                $str .= "<li id=\"$idStr-$count\" class=\"ui-state-default wells\" data-path=\"$menu->path\" data-model=\"$menu->model\" data-alias=\"$menu->alias\" data-title=\"$menu->title\" data-depth=\"$menu->depth\" data-id=\"$menu->id\" data-item=\"$count\">$img $menu->title";
                $str .= "<span class=\"glyphicon glyphicon-remove del\"></span>";
                $str .= "<span class=\"glyphicon glyphicon-chevron-down showInput\"></span>";
                $str .= "<p class=\"form-group hide\"><label>".Module::t('translit','title')."<input class=\"form-control tilteInput\" placeholder=\" ".Module::t('translit','Enter title')."\" type=\"text\"></label></p>";
                $str .= "<p class=\"form-group hide\"><label>".Module::t('translit','class')."<input class=\"form-control classInput\" placeholder=\"".Module::t('translit','Enter class')."\" type=\"text\"></label></p>";
                $str .= "<p class=\"form-group hide\"><label>".Module::t('translit','id')."<input class=\"form-control idInput\" placeholder=\"".Module::t('translit','Enter id')."\" type=\"text\"></label></p>";
                if(!empty($module->imageSetPath)&&!empty($module->imageResize)){
                    $str .='<p class="form-group hide">';
                    $str .=Html::a(Module::t('translit','Download image'),'#', ['data-url'=>Url::to(["/menu/menuget/create"]), 'class'=>'showDropFile']);
                    $str .='</p>';
                }
                $str .='</li>';
                $count++;

            }
            return $str;
        }else{
            return Module::t('translit','notMenu');
        }
        
        

    }
}