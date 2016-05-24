<?php

namespace kivanceren\photoalbum\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use kivanceren\photoalbum\models\Photos;

/**
 * PhotosSearch represents the model behind the search form about `frontend\models\Photos`.
 */
class PhotosSearch extends Photos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'album_id'], 'integer'],
            [['filename', 'caption', 'alt_text'], 'safe'],
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
        $query = Photos::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'album_id' => $this->album_id,
        ]);

        $query->andFilterWhere(['like', 'filename', $this->filename])
            ->andFilterWhere(['like', 'caption', $this->caption])
            ->andFilterWhere(['like', 'alt_text', $this->alt_text]);

        return $dataProvider;
    }
}
