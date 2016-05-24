<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PhotosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Photos';
$this->params['breadcrumbs'][] = $this->title;
$durum;
$id;
$friends;
try {
    $id=$_GET['number'];
    $durum='1';
} catch (Exception $e) {
   $id='0';
    $durum='0';
}

try {
    $friends=$_GET['friends'];
    
} catch (Exception $e) {
   $friends='0';
}



?>
<div class="photos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    
   
     <?php 
      $temp  = array();
      $items=array();
      if($durum=='0')
      {
          $album_list = Yii::$app->db->createCommand("Select * from album where owner_id=".Yii::$app->user->getId())->queryAll();
          foreach ($album_list as $key => $value) {
                     $temp = Yii::$app->db->createCommand("Select * from photos where album_id=".$value["id"])->queryAll();
                      foreach ($temp as $key => $photos) {
                                $items[]=[
                                            'url' => Yii::$app->request->BaseUrl . "/uploads/" . $photos["filename"],
                                            'src' => Yii::$app->request->BaseUrl . "/uploads/".$photos["filename"],
                                            'options' => array('title' => $photos["caption"])
                                        ];
                      }
          }
          
      }
      else{
          $sql = Yii::$app->db->createCommand("Select * from photos where album_id=".$id)->queryAll();
      foreach ($sql as $key => $value) {
         $items[]=[
                        'url' => Yii::$app->request->BaseUrl . "/uploads/" . $value["filename"],
                        'src' => Yii::$app->request->BaseUrl . "/uploads/".$value["filename"],
                        'options' => array('title' => $value["caption"])
                  ];
        
      }
    }



    ?>

    <?= dosamigos\gallery\Gallery::widget(['items' => $items]);?>


</div>
