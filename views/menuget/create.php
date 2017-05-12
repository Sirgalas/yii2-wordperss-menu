<?php

use yii\helpers\Html;
use yii\web\View;


?>
<div class="menu-create patern">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['allModels'=>$allModels, 'model'=>$model,'module'=>$module]) ?>

</div>