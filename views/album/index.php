<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Albums';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-index">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <?= Html::a('<span class="glyphicon glyphicon-plus"></span>',
                                    ['album/create']
                                );?>
   

    <?= 


    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           
            'name',
            'tags',
            'shareable',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{view} {update} {yetki} {delete}',
               
            'buttons' => [

               'view' => function ($data,$model) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                                    ['photos/index','number'=>$model->id]
                                );
                },

                'yetki' => function ($data,$model) {
                                return Html::a('<span class="glyphicon glyphicon-user"></span>',
                                    ['album/access','name'=>$model->name , 'id'=>$model->id]
                                );
                },

                  
                 

            ],
            ],
        ],
    ]); ?>

</div>
