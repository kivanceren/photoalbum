<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\photoalbum\models\Friends */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="friends-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userOne')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userTwo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
