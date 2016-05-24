<?php

namespace kivanceren\photoalbum\controllers;

use Yii;
use kivanceren\photoalbum\models\User;
use kivanceren\photoalbum\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kivanceren\photoalbum\models\FriendsSearch;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


         $searchModelOne = new FriendsSearch();
        $dataProviderOne = $searchModelOne->searchWait(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelOne' => $searchModelOne,
            'dataProviderOne' => $dataProviderOne,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionFriendship($username,$name,$surname)
    {
        $fname = Yii::$app->user->identity->firstname;
        $lname = Yii::$app->user->identity->lastname;
       $sql=(new \yii\db\Query())->createCommand()->insert('friends',['userOne'=>Yii::$app->user->identity->username,'oFN'=>$fname,'oLN'=>$lname,
       'userTwo'=>$username,'tFN'=>$name,'tLN'=>$surname,'state'=>'wait'])->execute();

         $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->redirect(['user/index']);
        
    }

    public function actionEkle($username)
    {
            $user = Yii::$app->user->identity->username;
       $sql=(new \yii\db\Query())->createCommand()->update('friends',['state'=>'done'] , 'userOne ='. "'$username'".' and userTwo='. "'$user'")->execute();
       

         $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

         return $this->redirect(['user/index']);
        
    }

    public function actionSil($username)
    {

         $user = Yii::$app->user->identity->username;
        $sql=(new \yii\db\Query())->createCommand()->delete('friends', 'userOne ='. "'$username'".' and userTwo='. "'$user'")->execute();
 

         return $this->redirect(['user/index']);
        
    }

   




    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id=Yii::$app->user->identity->id;
        $username=Yii::$app->user->identity->username;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

        Yii::$app->db->createCommand()->update('user', ['firstname' => $model->firstname , 'lastname'=>$model->lastname], 'id = '.$id)->execute();
        Yii::$app->db->createCommand()->update('yetki', ['name' => $model->firstname , 'surname'=>$model->lastname], 'username ='. "'$username'")->execute();

        Yii::$app->db->createCommand()->update('friends', ['oFN' => $model->firstname , 'oLN'=>$model->lastname],  'userOne ='. "'$username'")->execute();

        Yii::$app->db->createCommand()->update('friends', ['tFN' => $model->firstname , 'tLN'=>$model->lastname],  'userTwo ='. "'$username'")->execute();


            return $this->redirect(['album/index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionGuncelle()
    {
        $id=Yii::$app->user->identity->id;
        $user = User::findOne($id);

        $user->firstname = $model->firstname;
        $user->lastname = $model->lastname;
        $user->email  = $model->email;
        //$user->update();
       
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
