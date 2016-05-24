<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->params['breadcrumbs'][] = $this->title;

$name;
$id;
try {
    $name=$_GET['name'];
  
} catch (Exception $e) {
   $name='nothing';
    
}

try {
    $id=$_GET['id'];
  
} catch (Exception $e) {
   $name='0';
    
}

$this->title = $name .' Yetkilendirmesi';

?>
<div class="album-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           

            'userOne',
            'oFN',
            'oLN',
            'userTwo',
            'tFN',
            'tLN',  
            

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{link}',
               
            'buttons' => [



               'link' => function ($data,$model) {

                 $one = strcasecmp($model->userOne, Yii::$app->user->identity->username);
                 $friends = $model->userOne;
                 $name = $model->oFN;
                 $surname=$model->oLN;
                 if($one == '0') {
                    $friends = $model->userTwo;
                    $name = $model->tFN;
                    $surname=$model->tLN;
                }
                                return Html::a('<span class="glyphicon glyphicon-plus"></span>', 
                                    ['album/sharable','albumId'=>$_GET['id'],'username'=>$friends,'name'=>$name,'surname'=>$surname]
                                );
                },

                  
                 

            ],],
        ],
    ]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProviderOne,
       
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           

            'username',
            'name',
            'surname',  
            

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{delete}',
               
            'buttons' => [


               'delete' => function ($data,$model) {

                                return Html::a('<span class="glyphicon glyphicon-plus"></span>', 
                                    ['album/del','id'=>$model->id]
                                );
                },

                  
                 

            ],],
        ],
    ]); ?>
    
 
   


</div>
