<?php

namespace sirgalas\menu\controllers;


use sirgalas\menu\models\MenuSearch;
use sirgalas\menu\models\UploadImage;
use sirgalas\menu\models\Translit;
use sirgalas\menu\models\Imagerisize;
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
           $uploadModel=new UploadImage();
           if (Yii::$app->request->isAjax) {
               $transliterator=new Translit();
               $imagine= new Imagerisize();
               $basePath=date('Y').'/'.date('m');
               $fileName = 'file';
               $uploadPath =$module->imageDownloadPath.''.$basePath;
               $request=Yii::$app->request;
               if($request->isPost){
                   if (isset($_FILES[$fileName])) {
                       if (file_exists($uploadPath)) {

                       } else {

                           if (mkdir($uploadPath, 0777, true)) {}else{
                               $error = error_get_last();
                               return var_dump($error['message']);
                           }
                       }
                       $file = \yii\web\UploadedFile::getInstanceByName($fileName);
                       $filenames = $transliterator->traranslitImg($file);
                       if ($file->saveAs($uploadPath . '/' . $filenames)) {
                           $imagine->imagerisize($uploadPath, $filenames,$module);
                           return $this->render('create', [
                               'model' => $model,
                               'module' => $module,
                               'uploadModel' => $uploadModel
                           ]);
                       }
                   }
               }else{
                   $get=Yii::$app->request->get();
                   foreach ($module->models as $value){
                        if($value['class']===$get['className']){
                            $found =$value;
                            break;
                        }
                   }
                   return $this->renderAjax('_dropfile', [
                       'model'  => $model,
                       'module' => $module,
                       'found'  =>$found,
                       'id'     =>  $get['id'],
                       'uploadModel' => $uploadModel
                   ]);
               }
           }
           return $this->render('create',[
               /*'allModels'  =>  $module->getAllModels(),*/
               'model'      =>  $model,
               'module'     =>  $module,
               'found'      =>  null,
               'uploadModel' =>  $uploadModel
           ]);
       }
}