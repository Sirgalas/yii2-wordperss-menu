<?php

namespace sirgalas\menu\controllers;


use yii\web\Controller;
use sirgalas\menu\models\MenuGet;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use Yii;

class MenugetController extends Controller
{
       public function actionIndex(){
           $module=$this->module;
           $model= new MenuGet();
           return $this->render('create',[
               'allModels'=>$module->getAllModels(),
               'model'=>$model
           ]);
           
       }
}