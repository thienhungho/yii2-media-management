<?php

namespace thienhungho\MediaManagement\models;

/**
 * This is the model class for table "media".
 */
class Uploads
{
    /**
     * @return bool|string
     */
    public static function getUploadDir()
    {
        return \Yii::getAlias('@uploads');
    }

    /**
     * @param string $form_name
     * @param array $data
     *
     * @return null|string
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public static function upload($form_name = 'file', $data = [])
    {
        $settings = \Yii::$app->settings;
        if (!empty($data['quality'])) {
            $quality = $data['quality'];
        } else {
            $quality = Media::getConfigurationQuality(50);
        }
        $file = UploadedFile::getInstanceByName($form_name);
        if ($file) {
            $file->name = str_replace([' ', '(', ')'], '-', trim(addslashes($file->name)));
            $uploadDir = self::getUploadDir();
            FileHelper::createDirectory(self::getUploadDir() . '/' . date('Y/m/d'));
            $fileName = date('Y/m/d') . '/' . date('his') . '-' . $file->name;
            $fileName_save = $uploadDir . '/' . $fileName;
            $file->saveAs($fileName_save);
            Image::getImagine()->open($fileName_save)->save($fileName_save, ['quality' => $quality]);
            $url = 'uploads/' . $fileName;

            $media = new Media([
                'name' => $file->name,
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

            /**
             * Generate All Other size
             */
            if (empty($thumbnailDir)) {
                $thumbnailDir = \Yii::getAlias('@thumbnail');
            }
            FileHelper::createDirectory($thumbnailDir . '/' . date('Y/m/d'));
            $thumbnail_save = $thumbnailDir . '/' . $fileName;
            $thumbnail_size_width = Media::getConfigurationThumbnailSizeWidth();
            $thumbnail_size_height = Media::getConfigurationThumbnailSizeHeight();
            Image::getImagine()->open($fileName_save)->thumbnail(new Box($thumbnail_size_width, $thumbnail_size_height))->save($thumbnail_save , ['quality' => $quality]);
            if (empty($mediumDir)) {
                $mediumDir = \Yii::getAlias('@medium');
            }
            FileHelper::createDirectory($mediumDir. '/' . date('Y/m/d'));
            $medium_save = $mediumDir . '/' . $fileName;
            $medium_size_width = Media::getConfigurationMediumSizeWidth();
            $medium_size_height = Media::getConfigurationMediumSizeHeight();
            Image::getImagine()->open($fileName_save)->thumbnail(new Box($medium_size_width, $medium_size_height))->save($medium_save , ['quality' => $quality]);
            if (empty($largeDir)) {
                $largeDir = \Yii::getAlias('@large');
            }
            FileHelper::createDirectory($largeDir . '/' . date('Y/m/d'));
            $large_save = $largeDir  . '/' . $fileName;
            $large_size_width = Media::getConfigurationLargeSizeWidth();
            $large_size_height = Media::getConfigurationLargeSizeHeight();
            Image::getImagine()->open($fileName_save)->thumbnail(new Box($large_size_width, $large_size_height))->save($large_save , ['quality' => $quality]);
            return $url;
        } else {
            return null;
        }
    }
}
