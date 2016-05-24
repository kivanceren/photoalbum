<?php

namespace kivanceren\photoalbum\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "photos".
 *
 * @property integer $id
 * @property integer $album_id
 * @property string $filename
 * @property string $caption
 * @property string $alt_text
 *
 * @property Comment[] $comments
 * @property Album $album
 */
class Photos extends \yii\db\ActiveRecord
{
    public $upload_file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['album_id','caption', 'alt_text'], 'required'],
            [['album_id'], 'integer'],
            [['filename'], 'string', 'max' => 255],
            [['caption', 'alt_text'], 'string', 'max' => 80],
             [['upload_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, png, mp4 , mp4a', 'mimeTypes' => 'image/jpeg, image/png, video/mp4 , audio/mp4',],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'album_id' => 'Album ID',
            'caption' => 'Caption',
            'alt_text' => 'Alt Text',

            'upload_file' => 'Upload File',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['photo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbum()
    {
        return $this->hasOne(Album::className(), ['id' => 'album_id']);
    }

   public function uploadFile() {
        // get the uploaded file instance
        $image = UploadedFile::getInstance($this, 'upload_file');
 
        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }
 
        // generate random name for the file
        $this->filename = time(). '.' . $image->extension;
 
        // the uploaded image instance
        return $image;
    }
 
    public function getUploadedFile() {
        // return a default image placeholder if your source avatar is not found
        $filename = isset($this->filename) ? $this->filename : 'default.png';
        return Yii::$app->params['fileUploadUrl'] . $filename;
    }

    public function getImageurl()
    {
         return \Yii::$app->request->BaseUrl.'/uploads/'.$this->logo;
    }

   
}
