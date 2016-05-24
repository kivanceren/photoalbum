<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\photoalbum\models\Friends */


$this->params['breadcrumbs'][] = ['label' => 'Friends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friends-view">

    <h1> Genel Paylaşıma Açık Albümler</h1>

    <?=GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           
            'name',
            'tags',
            'shareable',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{view}',
               
            'buttons' => [

               'view' => function ($data,$model) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                                ['friends/photos','number'=>$model->id]);
                                
                },

                  
                 

            ],
            ],
        ],
    ]); ?>



    <h1>Yetkilendirildiğiniz Albümler</h1>

    <?=GridView::widget([
        'dataProvider' => $dataProviderOne,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'tags',
            'shareable',
           

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{view}',
               'buttons' => [

               'view' => function ($data,$model) {
                                echo $model['name'];
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                                 ['friends/photos','number'=>$model["id"]]);
                                
                },

                  
                 

            ],
            
            ],
        ],
    ]); ?>

    

</div>
