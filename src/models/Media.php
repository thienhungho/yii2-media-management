<?php

namespace thienhungho\MediaManagement\models;

use \thienhungho\MediaManagement\modules\MediaBase\Media as BaseMedia;

/**
 * This is the model class for table "media".
 */
class Media extends BaseMedia
{
    /**
     * @return mixed
     */
    public static function getConfigurationThumbnailSizeWidth($defaultValue = 150) {
        return get_setting_value('media_configuration', 'thumbnail_size_width', $defaultValue);
    }

    /**
     * @return mixed
     */
    public static function getConfigurationThumbnailSizeHeight($defaultValue = 150) {
        return get_setting_value('media_configuration', 'thumbnail_size_height', $defaultValue);
    }

    /**
     * @return mixed
     */
    public static function getConfigurationMediumSizeWidth($defaultValue = 300) {
        return get_setting_value('media_configuration', 'medium_size_width', $defaultValue);
    }

    /**
     * @return mixed
     */
    public static function getConfigurationMediumSizeHeight($defaultValue = 300) {
        return get_setting_value('media_configuration', 'medium_size_height', $defaultValue);
    }

    /**
     * @return mixed
     */
    public static function getConfigurationLargeSizeWidth($defaultValue = 1024) {
        return get_setting_value('media_configuration', 'large_size_width', $defaultValue);
    }

    /**
     * @return mixed
     */
    public static function getConfigurationLargeSizeHeight($defaultValue = 1024) {
        return get_setting_value('media_configuration', 'large_size_height', $defaultValue);
    }

    /**
     * @return mixed
     */
    public static function getConfigurationQuality($defaultValue = 5) {
        return get_setting_value('media_configuration', 'quality', $defaultValue);
    }
}
