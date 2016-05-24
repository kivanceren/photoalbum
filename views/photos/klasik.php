<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use frontend\modules\photoalbum\models\Photos;
use yii\db\Query;



/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PhotosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Photos';
$this->params['breadcrumbs'][] = $this->title;

$durum;
$id;
$duzen;
try {
    $id=$_GET['number'];
    $durum='1';
} catch (Exception $e) {
   $id='0';
    $durum='0';
}

try {
    $duzen=$_GET['duzen'];
  
} catch (Exception $e) {
   $duzen=0;
}

$dataProvider = $dataProvider = new ActiveDataProvider([
            'query' => Photos::find()->where(['album_id'=>''.$id]),
        ]);


?>
<div class="photos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Photos', ['create','number'=>$id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Galeri Görünümü', ['index' , 'number'=>$id,'duzen'=>'1'], ['class' => 'btn btn-primary']) ?>
    </p>


     <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           
            'caption',
             [
               'attribute' => 'img',
               'format' => 'html',
               'label' => 'Resim',
            'value' => function ($data) {
                            return Html::img(Yii::$app->request->BaseUrl . "/uploads/" . $data['filename'],
                ['width' => '60px']);
            },
            ],
            'alt_text',
            

            ['class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>

</div>
