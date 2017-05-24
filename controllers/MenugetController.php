<?php

namespace sirgalas\menu\controllers;


use sirgalas\menu\models\MenuSearch;
use yii\web\Controller;
use sirgalas\menu\models\MenuGet;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use Yii;

class MenugetController extends Controller
{
    public function actionIndex(){
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index',[
            'module'=>$this->module,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

       public function actionCreate(){
           $module=$this->module;
           $model= new MenuGet();
           return $this->render('create',[
               /*'allModels'  =>  $module->getAllModels(),*/
               'model'      =>  $model,
               'module'     =>  $module
           ]);
           
       }
}