<?php

namespace kivanceren\photoalbum\controllers;

use Yii;
use kivanceren\photoalbum\models\Friends;
use kivanceren\photoalbum\models\FriendsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use  yii\data\ActiveDataProvider;
use kivanceren\photoalbum\models\Album;
use kivanceren\photoalbum\models\User;
use yii\db\Query;
/**
 * FriendsController implements the CRUD actions for Friends model.
 */
class FriendsController extends Controller
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
     * Lists all Friends models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FriendsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPhotos($number)
    {

        return $this->render('photos', [
            'number' => $number,
        ]);
    }

    /**
     * Displays a single Friends model.
     * @param string $userOne
     * @param string $userTwo
     * @return mixed
     */
    public function actionView($user)
    {

       
        $model = User::find()->where('username = :username', [':username' => $user])->one();
        $owner_id=$model["id"];

        $dataProvider = new ActiveDataProvider([
            'query' => Album::find()->where(['owner_id'=>''.$owner_id  , 'shareable'=>'1']),
        ]);

        $query = new Query;


        $dataProviderOne = new ActiveDataProvider([
            'query' => $query->select("*")->from('album')->innerJoin('yetki',
         'yetki.id' .'=' .'album.id')->where('owner_id = '.$owner_id),
        ]);
        
           
        return $this->render('view', [
            'dataProvider' => $dataProvider,
            'dataProviderOne'=>$dataProviderOne,
            
        ]);


    }

    /**
     * Creates a new Friends model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Friends();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userOne' => $model->userOne, 'userTwo' => $model->userTwo]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Friends model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $userOne
     * @param string $userTwo
     * @return mixed
     */
    public function actionUpdate($userOne, $userTwo)
    {
        $model = $this->findModel($userOne, $userTwo);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userOne' => $model->userOne, 'userTwo' => $model->userTwo]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Friends model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $userOne
     * @param string $userTwo
     * @return mixed
     */
    public function actionDelete($userOne, $userTwo)
    {
        $this->findModel($userOne, $userTwo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Friends model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $userOne
     * @param string $userTwo
     * @return Friends the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($userOne, $userTwo)
    {
        if (($model = Friends::findOne(['userOne' => $userOne, 'userTwo' => $userTwo])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
