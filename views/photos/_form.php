<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\modules\photoalbum\models\Album;
use yii\db\Query;



/* @var $this yii\web\View */
/* @var $model frontend\models\Photos */
/* @var $form yii\widgets\ActiveForm */
$id;
try {
    $id=$_GET['id'];
   
} catch (Exception $e) {
   $id=$_GET['number'];
}
$name=$_SERVER['HTTP_REFERER'];
?>

<div class="photos-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>
    
    <?php 
   
     $actual_link = "$_SERVER[REQUEST_URI]";
     $pos = strpos($actual_link, "update");
     if ($pos === false) {
                            $model['album_id'] = $id;
        } else {

                        $connection = \Yii::$app->db;
                        $sql = $connection->createCommand("Select album_id from photos where id=".$id);
                        $sqlRequest = $sql->queryOne();
                        echo $sqlRequest["album_id"];

                        $model['album_id'] = $sqlRequest["album_id"];
        }
 
      
    ?>
    
    <?= $form->field($model, 'album_id')->textInput(['readonly' => true]) ?>
    

     <?= $form->field($model, 'caption')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'upload_file')->fileInput() ?>

    <?= $form->field($model, 'alt_text')->textInput(['maxlength' => true]) ?>

    <?= Html::submitButton('Submit') ?>

    <?php ActiveForm::end(); ?>

</div>



    

    


