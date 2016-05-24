<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\photoalbum\models\User */
/* @var $form yii\widgets\ActiveForm */



?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

  

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    

    <div class="form-group">
     
    <?= Html::submitButton(Yii::t('app', 'save'), ['class' =>  'btn btn-primary' ]) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
