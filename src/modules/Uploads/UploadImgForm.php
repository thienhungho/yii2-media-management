<?php
/**
 * Created by PhpStorm.
 * User: thienhung
 * Date: 7/22/18
 * Time: 15:16
 */

namespace thienhungho\MediaManagement\modules\uploads;

use thienhungho\MediaManagement\modules\media\Media;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;
use Imagine\Image\Box;

class UploadImgForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $imageFiles;

    /**
     * @return array
     * maxFiles => 0 will define unlimited file accept
     */
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg ,gif'],
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg ,gif', 'maxFiles' => 0],
        ];
    }

    /**
     * @param $defaultQuality
     * @param array $data
     *
     * @return mixed
     */
    public static function getQualitySetting($defaultQuality, $data = [])
    {
        if (!empty($data['quality'])) {
            return $data['quality'];
        }
        return \Yii::$app->settings->get('media_configuration', 'quality', $defaultQuality);
    }

    /**
     * @param array $data
     *
     * @return bool|mixed|string
     */
    public static function getUploadDir($data = [])
    {
        if (!empty($data['upload_dir'])) {
            return $data['upload_dir'];
        }
        return \Yii::getAlias('@uploads');
    }

    /**
     * @param $file_name
     *
     * @return string
     * @throws \yii\base\Exception
     */
    public static function getFileNameSave($file_name)
    {
        FileHelper::createDirectory(self::getUploadDir() . '/' . date('Y/m/d'));
        return self::getUploadDir() . '/' . $file_name;
    }

    /**
     * @param $file_name
     * @param $fileName_save
     * @param $url
     * @param array $data
     *
     * @throws \yii\base\InvalidConfigException
     */
    public static function createNewMedia($file_name, $fileName_save, $url, $data = [])
    {
        $media = new Media([
            'name' => $file_name,
            'path' => $url,
            'type' => FileHelper::getMimeType($fileName_save),
            'file_size' => filesize($fileName_save),
            'dimensions' => getimagesize($fileName_save)[0] . 'x' . getimagesize($fileName_save)[1],
        ]);
        if (!empty($data['title'])) {
            $media->title = $data['title'];
        }
        if (!empty($data['caption'])) {
            $media->caption = $data['caption'];
        }
        if (!empty($data['alt'])) {
            $media->alt = $data['alt'];
        }
        if (!empty($data['description'])) {
            $media->description = $data['description'];
        }
        if (!\Yii::$app->user->isGuest) {
            $media->created_by = \Yii::$app->user->id;
        }
        $media->save();
    }

    /**
     * @param $fileName
     * @param array $data
     *
     * @throws \yii\base\Exception
     */
    public static function generateThumbnail($fileName, $data = [])
    {
        FileHelper::createDirectory( \Yii::getAlias('@thumbnail') . '/' . date('Y/m/d'));
        $thumbnail_save =  \Yii::getAlias('@thumbnail') . '/' . $fileName;
        $size_width = get_setting_value('media_configuration', 'thumbnail_size_width', 150);
        $size_height = get_setting_value('media_configuration', 'thumbnail_size_height', 150);
        Image::getImagine()
            ->open(self::getFileNameSave($fileName))
            ->thumbnail(new Box($size_width, $size_height))
            ->save($thumbnail_save , ['quality' => self::getQualitySetting(50, $data)]);

        FileHelper::createDirectory(\Yii::getAlias('@medium') . '/' . date('Y/m/d'));
        $thumbnail_save = \Yii::getAlias('@medium') . '/' . $fileName;
        $size_width = get_setting_value('media_configuration', 'medium_size_width', 150);
        $size_height = get_setting_value('media_configuration', 'medium_size_height', 150);
        Image::getImagine()
            ->open(self::getFileNameSave($fileName))
            ->thumbnail(new Box($size_width, $size_height))
            ->save($thumbnail_save , ['quality' => self::getQualitySetting(50, $data)]);

        FileHelper::createDirectory(\Yii::getAlias('@large') . '/' . date('Y/m/d'));
        $thumbnail_save = \Yii::getAlias('@large') . '/' . $fileName;
        $size_width = get_setting_value('media_configuration', 'large_size_width', 150);
        $size_height = get_setting_value('media_configuration', 'large_size_height', 150);
        Image::getImagine()
            ->open(self::getFileNameSave($fileName))
            ->thumbnail(new Box($size_width, $size_height))
            ->save($thumbnail_save , ['quality' => self::getQualitySetting(50, $data)]);
    }

    /**
     * @param string $form_name
     * @param array $data
     *
     * @return null|string
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    protected function doUploadSingle($form_name = 'img', $data = [])
    {
        $this->imageFile = UploadedFile::getInstanceByName($form_name);
        $quality = self::getQualitySetting(50, $data);
        if ($this->imageFile) {
            $fileName = date('Y/m/d') . '/' . date('his') . '-' . $this->imageFile->baseName. '.' . $this->imageFile->extension;
            $fileName_save = self::getFileNameSave($fileName);
            $this->imageFile->saveAs($fileName_save);
            Image::getImagine()->open($fileName_save)->save($fileName_save, ['quality' => $quality]);
            self::generateThumbnail($fileName, $data);
            $url = 'uploads/' . $fileName;
            self::createNewMedia($fileName, $fileName_save, $url, $data);
            return $url;
        } else {
            return null;
        }
    }

    /**
     * @param string $form_name
     * @param array $data
     *
     * @return array|null
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    protected function doUploadMultiple($form_name = 'img', $data = [])
    {
        $this->imageFiles = UploadedFile::getInstancesByName($form_name);
        $quality = self::getQualitySetting(50, $data);
        if ($this->imageFiles) {
            $url = [];
            foreach ($this->imageFiles as $file) {
                $model = new UploadImgForm();
                $model->imageFile = $file;
                $fileName = date('Y/m/d') . '/' . date('his') . '-' . $model->imageFile->baseName. '.' . $model->imageFile->extension;
                $fileName_save = self::getFileNameSave($fileName);
                $model->imageFile->saveAs($fileName_save);
                Image::getImagine()->open($fileName_save)->save($fileName_save, ['quality' => $quality]);
                self::generateThumbnail($fileName, $data);
                $url[] = 'uploads/' . $fileName;
                self::createNewMedia($fileName, $fileName_save, 'uploads/' . $fileName, $data);
            }
            return $url;
        } else {
            return null;
        }
    }

    /**
     * @param string $form_name
     * @param bool $multiple
     * @param array $data
     *
     * @return array|null|string
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public static function upload($form_name = 'img', $multiple = false, $data = [])
    {
        $model = new UploadImgForm();
        if ($multiple == false) {
            return $model->doUploadSingle($form_name, $data);
        } else {
            return $model->doUploadMultiple($form_name, $data);
        }
    }
}