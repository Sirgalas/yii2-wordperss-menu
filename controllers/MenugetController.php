<?php

namespace sirgalas\menu\controllers;


use sirgalas\menu\models\MenuSearch;
use sirgalas\menu\models\UploadImage;


use yii\helpers\Json;
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
               $request=Yii::$app->request;
               if($request->isPost){
                   $fileName = 'file';
                   if (isset($_FILES[$fileName])) {
                       $file = \yii\web\UploadedFile::getInstanceByName($fileName);
                       $uplImg=$uploadModel->upload($file ,$module);
                       if ($uplImg) {
                           return $this->render('create', [
                               'model' => $model,
                               'module' => $module,
                               'uploadModel' => $uploadModel
                           ]);
                       }else{
                       return var_dump($file);
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
           if ($model->load(Yii::$app->request->post())&&$model->save()) {
                   return $this->redirect('index');
           }
               return $this->render('create', [
                   'model' => $model,
                   'module' => $module,
                   'found' => null,
                   'uploadModel' => $uploadModel
               ]);
           }

        public function actionUpdate($id){
            $model = $this->findModel($id);
            $module=$this->module;
            if(empty($module->modelDb)) {
                $feild = 'content';
            }else{
                $feild = $module->modelDb['content'];
            }
            $uploadModel=new UploadImage();
            if (Yii::$app->request->isAjax) {
                $request=Yii::$app->request;
                if($request->isPost){
                    $fileName = 'file';
                    if (isset($_FILES[$fileName])) {
                        $file = \yii\web\UploadedFile::getInstanceByName($fileName);
                        $uplImg=$uploadModel->upload($file ,$module);
                        if ($uplImg) {
                            return $this->render('create', [
                                'model' => $model,
                                'module' => $module,
                                'uploadModel' => $uploadModel
                            ]);
                        }else{
                            return var_dump($file);
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
            if ($model->load(Yii::$app->request->post())&&$model->save()) {
                return $this->redirect('index');
            }
            $jsonObj=Json::decode($model->$feild,false);
            return $this->render('update', [
                'model' => $model,
                'module' => $module,
                'found' => null,
                'jsonObj'=> $jsonObj,
                'uploadModel' => $uploadModel
            ]);
        }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect('index');
    }



        protected function findModel($id)
        {
            $module=$this->module;
            if(empty($module->modelDb)) {
                $model = MenuGet::findOne($id);
            }else{
                $model = MenuGet::findOne([$module->modelDb['id']=>$id]);
            }
            if ($model !== null) {
                return $model;
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }

}