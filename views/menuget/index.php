<?php

use yii\helpers\Html;
use yii\grid\GridView;
use sirgalas\menu\Module;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\FrontendSetupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('Menu setup');
$this->params['breadcrumbs'][] = $this->title;
 ?>
<div class="frontend-setup-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend','Create menu'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
   
    if(empty($module->modelDb)){ ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    <?php }else{ ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            $module->name,
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php } ?>
</div>
