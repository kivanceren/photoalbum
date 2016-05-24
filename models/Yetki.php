<?php

namespace kivanceren\photoalbum\models;

use Yii;

/**
 * This is the model class for table "yetki".
 *
 * @property integer $id
 * @property string $username
 * @property string $name
 * @property string $surname
 *
 * @property Album $id0
 * @property User $username0
 */
class Yetki extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yetki';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'username', 'name', 'surname'], 'required'],
            [['id'], 'integer'],
            [['username'], 'string', 'max' => 255],
            [['name', 'surname'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'name' => 'Name',
            'surname' => 'Surname',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Album::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsername0()
    {
        return $this->hasOne(User::className(), ['username' => 'username']);
    }
}
