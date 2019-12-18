<?php


namespace backend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadFile extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $newImageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->setNewImageFile();
            $this->imageFile->saveAs($this->getFolder() . $this->newImageFile);
            return true;
        } else {
            return false;
        }
    }

    public function setNewImageFile() {
        $this->newImageFile = Yii::$app->security->generateRandomString().".".$this->imageFile->extension;
    }

    public function getFolder() {
        return Yii::getAlias('@frontend')."/web/images/products/";
    }
}