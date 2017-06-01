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
               $basePath='/'.date('Y').'/'.date('m').'/';
               $fileName = 'file';
               $uploadPath =''.$basePath;
               if (isset($_FILES[$fileName])) {
                   if (file_exists($uploadPath)) {
                   } else {
                       //mkdir($uploadPath, 0775, true);
                   }
                   $file = \yii\web\UploadedFile::getInstanceByName($fileName);
                   $filenames=$transliterator->traranslitImg($file);
                   if ($file->saveAs($uploadPath . '/' . $filenames)) {
                       $imagine->imagerisizegods($uploadPath,$filenames,$file);
                       return $this->render('create', [
                           'model'      =>  $model,
                           'module'     =>  $module,
                           'uploadModel' =>  $uploadModel
                       ]);
                   }
               }else{
                   $post=Yii::$app->request->post();
                   $found=null;
                   foreach ($module->models as $value){
                        if($value['class']===$post['className']){
                            $found =$value;
                            break;
                        }
                   }
                  
                   if(isset($found['imagePath'])&&isset($found['imageResize'])){
                       return 'yes';
                   }else{
                       return 'no';
                   }
                   
               }
           }
           return $this->render('create',[
               /*'allModels'  =>  $module->getAllModels(),*/
               'model'      =>  $model,
               'module'     =>  $module,
               'uploadModel' =>  $uploadModel
           ]);
           
       }
}