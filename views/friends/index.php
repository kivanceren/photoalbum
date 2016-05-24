<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\photoalbum\models\FriendsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Friends';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friends-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
  
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

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{view} {delete}',
               
            'buttons' => [



               'view' => function ($data,$model) {
                 $userN =   Yii::$app->user->identity->id;
                 $one = strcasecmp($model->userOne, Yii::$app->user->identity->username);
                 $friends = $model->userOne;
                 if($one == '0') 
                    $friends = $model->userTwo;
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 
                                    ['friends/view','user'=>$friends]
                                );
                },

                  
                 

            ],],
        ],
    ]); ?>

</div>
