<?php

namespace kivanceren\photoalbum\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use kivanceren\photoalbum\models\Friends;

/**
 * FriendsSearch represents the model behind the search form about `frontend\modules\photoalbum\models\Friends`.
 */
class FriendsSearch extends Friends
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userOne', 'oFN' , 'oLN','userTwo', 'tFN', 'tLN', 'state'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Friends::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $usename=Yii::$app->user->identity->username;
       
       $query->andFilterWhere(['like', 'userOne', $this->userOne])
            ->andFilterWhere(['like', 'oFN', $this->oFN])
            ->andFilterWhere(['like', 'oLN', $this->oLN])
            ->andFilterWhere(['like', 'userTwo', $this->userTwo])
            ->andFilterWhere(['like', 'tFN', $this->tFN])
            ->andFilterWhere(['like', 'tLN', $this->tLN])
            ->andFilterWhere(['like', 'state', $this->state]);
        $query->andFilterWhere(
            ['or',
            ['like','userOne',$usename],
            ['like','userTwo',$usename]]
            )->andFilterWhere(['like', 'state', "done"]);

      
      

        return $dataProvider;
    }


    public function searchWait($params)
    {
        $query = Friends::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $usename=Yii::$app->user->identity->username;
       
        $query->andFilterWhere(['like', 'userOne', $this->userOne])
            ->andFilterWhere(['like', 'userTwo', $this->userTwo]);
        $query->andFilterWhere(
            ['or',
            ['like','userOne',$usename],
            ['like','userTwo',$usename]]
            )->andFilterWhere(['like', 'state', "wait"]);
         $query->andFilterWhere(['not like' ,'userOne' , $usename]);
      

        return $dataProvider;
    }




    

    
}
