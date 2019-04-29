<?php

namespace thienhungho\MediaManagement\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class MediaConfigurationForm extends Model
{
    public $thumbnail_size_width;
    public $thumbnail_size_height;

    public $medium_size_width;
    public $medium_size_height;

    public $large_size_width;
    public $large_size_height;

    public $quality;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'thumbnail_size_width',
                    'thumbnail_size_height',
                    'medium_size_width',
                    'medium_size_height',
                    'large_size_width',
                    'medium_size_height',
                    'large_size_width',
                    'large_size_height',
                    'quality',
                ],
                'required',
            ],
            [
                [
                    'thumbnail_size_width',
                    'thumbnail_size_height',
                    'medium_size_width',
                    'medium_size_height',
                    'large_size_width',
                    'medium_size_height',
                    'large_size_width',
                    'large_size_height',
                    'quality',
                ],
                'integer',
            ],
            [
                [
                    'thumbnail_size_width',
                    'thumbnail_size_height',
                ],
                'default',
                'value' => 150,
            ],
            [
                [
                    'medium_size_width',
                    'medium_size_height',
                ],
                'default',
                'value' => 300,
            ],
            [
                [
                    'large_size_width',
                    'large_size_height',
                ],
                'default',
                'value' => 1024,
            ],
            [
                ['quality'],
                'default',
                'value' => 50,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'thumbnail_size_width' => Yii::t('app', 'Thumbnail size width'),
            'thumbnail_size_height' => Yii::t('app', 'Thumbnail size height'),
            'medium_size_width' => Yii::t('app', 'Medium size width'),
            'medium_size_height' => Yii::t('app', 'Medium size height'),
            'large_size_width' => Yii::t('app', 'Large size width'),
            'large_size_height' => Yii::t('app', 'Large size height'),
            'quality' => Yii::t('app', 'Quality'),
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function config()
    {
        if ($this->validate()) {
            $this->configImgSize();
            $this->configQuality();

            return true;
        }

        return false;
    }

    /**
     * Config Img size
     */
    private function configImgSize()
    {
        $settings = Yii::$app->settings;
        $settings->set('media_configuration', 'thumbnail_size_width', $this->thumbnail_size_width);
        $settings->set('media_configuration', 'thumbnail_size_height', $this->thumbnail_size_height);
        $settings->set('media_configuration', 'medium_size_width', $this->medium_size_width);
        $settings->set('media_configuration', 'medium_size_height', $this->medium_size_height);
        $settings->set('media_configuration', 'large_size_width', $this->large_size_width);
        $settings->set('media_configuration', 'large_size_height', $this->large_size_height);
    }

    /**
     * Config Quality
     */
    private function configQuality()
    {
        $settings = Yii::$app->settings;
        $settings->set('media_configuration', 'quality', $this->quality);
    }

}
