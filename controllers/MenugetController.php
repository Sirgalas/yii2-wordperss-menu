<?php

namespace sirgalas\menu\controllers;


use yii\web\Controller;

class MenugetController extends Controller
{
       public function actionIndex(){
           $module=$this->module;
           return var_dump($module->getAllModels());
       }
}