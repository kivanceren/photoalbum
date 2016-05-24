<?php

namespace kivanceren\photoalbum\models;

use Yii;

/**
 * This is the model class for table "friends".
 *
 * @property string $userOne
 * @property string $userTwo
 * @property string $state
 *
 * @property User $userTwo0
 * @property User $userOne0
 */
class Friends extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'friends';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userOne', 'userTwo', 'state'], 'required'],
            [['userOne', 'userTwo'], 'string', 'max' => 255],
            [['state'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userOne' => 'User One',
            'userTwo' => 'User Two',
            'state' => 'State',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTwo0()
    {
        return $this->hasOne(User::className(), ['username' => 'userTwo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserOne0()
    {
        return $this->hasOne(User::className(), ['username' => 'userOne']);
    }
}
