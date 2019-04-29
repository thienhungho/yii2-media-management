<?php

namespace thienhungho\MediaManagement\modules\MediaConfiguration\controllers;

use thienhungho\MediaManagement\models\MediaConfigurationForm;
use thienhungho\MediaManagement\models\Media;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Default controller for the `SiteConfiguration` module
 */
class MediaController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = new MediaConfigurationForm();
        $model->thumbnail_size_width = Media::getConfigurationThumbnailSizeWidth();
        $model->thumbnail_size_height = Media::getConfigurationThumbnailSizeHeight();
        $model->medium_size_width = Media::getConfigurationMediumSizeWidth();
        $model->medium_size_height = Media::getConfigurationMediumSizeHeight();
        $model->large_size_width = Media::getConfigurationLargeSizeWidth();
        $model->large_size_height = Media::getConfigurationLargeSizeHeight();
        $model->quality = Media::getConfigurationQuality();
        if ($model->load(\request()->post())) {
            if ($model->config()) {
                set_flash_has_been_saved();

                return $this->redirect(Url::to(['index']));
            } else {
                set_flash_has_not_been_saved();

                return $this->render('index', ['model' => $model]);
            }
        } else {
            return $this->render('index', ['model' => $model]);
        }
    }
}
