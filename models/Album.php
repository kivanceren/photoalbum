<?php

namespace kivanceren\photoalbum\models;

use Yii;

/**
 * This is the model class for table "album".
 *
 * @property integer $id
 * @property string $name
 * @property string $tags
 * @property integer $owner_id
 * @property integer $shareable
 *
 * @property User $owner
 * @property Photos[] $photos
 */
class Album extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'album';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'tags', 'owner_id', 'shareable'], 'required'],
            [['owner_id', 'shareable'], 'integer'],
            [['name', 'tags'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'tags' => 'Tags',
            'owner_id' => 'Owner ID',
            'shareable' => 'Shareable',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photos::className(), ['album_id' => 'id']);
    }


    public function getYetki()
    {
        return $this->hasOne(Yetki::className(), ['id' => 'id']);
    }
}
