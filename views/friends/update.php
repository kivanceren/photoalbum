<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\photoalbum\models\Friends */

$this->title = 'Update Friends: ' . ' ' . $model->userOne;
$this->params['breadcrumbs'][] = ['label' => 'Friends', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->userOne, 'url' => ['view', 'userOne' => $model->userOne, 'userTwo' => $model->userTwo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="friends-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
