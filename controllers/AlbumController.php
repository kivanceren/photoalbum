<?php

namespace kivanceren\photoalbum\controllers;

use Yii;
use kivanceren\photoalbum\models\Album;
use kivanceren\photoalbum\models\Photos;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kivanceren\photoalbum\models\Yetki;
use kivanceren\photoalbum\models\Friends;
use kivanceren\photoalbum\models\FriendsSearch;
/**
 * AlbumController implements the CRUD actions for Album model.
 */
class AlbumController extends Controller
{
    public function behaviors()
    {
        return [
        
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Album models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Album::find()->where(['owner_id'=>''.Yii::$app->user->getId()]),
        ]);

      

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

   public function actionAccess($name,$id)
    {
        

      $searchModel = new FriendsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProviderOne = new ActiveDataProvider([
            'query' => Yetki::find()->where(['id'=>''.$id]),
        ]);


        return $this->render('access', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'dataProviderOne' => $dataProviderOne,
        ]);
    }

    public function actionDel($id)
    {
            $sql=(new \yii\db\Query())->createCommand()->delete('yetki', 'id ='. "'$id'")->execute();
            $dataProvider = new ActiveDataProvider([
            'query' => Album::find()->where(['owner_id'=>''.Yii::$app->user->getId()]),
        ]);

      

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionSharable($albumId,$username,$name,$surname)
    {

    $sql=(new \yii\db\Query())->createCommand()->insert('yetki',['id'=>$albumId,'username'=>$username,'name'=>$name,
       'surname'=>$surname])->execute();

        $dataProvider = new ActiveDataProvider([
            'query' => Album::find()->where(['owner_id'=>''.Yii::$app->user->getId()]),
        ]);

      

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);


    }

    /**
     * Displays a single Album model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $dataProvider = new ActiveDataProvider ([
                'query' => Photos::find()->where(['album_id'=>''.$id]),
            ]
            );
        return $this->render('view', [
            'model' => $this->findModel($id), 'dataProvider'=>$dataProvider, 
        ]);
    }

    /**
     * Creates a new Album model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Album();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->owner_id = 2;
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->owner_id = 2;
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Album model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Album model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Album model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Album the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Album::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
