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
    public static function getConfigurationThumbnailSizeWidth() {
        return get_setting_value('media_configuration', 'thumbnail_size_width', 150);
    }

    /**
     * @return mixed
     */
    public static function getConfigurationThumbnailSizeHeight() {
        return get_setting_value('media_configuration', 'thumbnail_size_height', 150);
    }

    /**
     * @return mixed
     */
    public static function getConfigurationMediumSizeWidth() {
        return get_setting_value('media_configuration', 'medium_size_width', 300);
    }

    /**
     * @return mixed
     */
    public static function getConfigurationMediumSizeHeight() {
        return get_setting_value('media_configuration', 'medium_size_height', 300);
    }

    /**
     * @return mixed
     */
    public static function getConfigurationLargeSizeWidth() {
        return get_setting_value('media_configuration', 'large_size_width', 1024);
    }

    /**
     * @return mixed
     */
    public static function getConfigurationLargeSizeHeight() {
        return get_setting_value('media_configuration', 'large_size_height', 1024);
    }

    /**
     * @return mixed
     */
    public static function getConfigurationQuality() {
        return get_setting_value('media_configuration', 'quality', 5);
    }
}
