<?php

/**
 * @param $form_name
 * @param bool $multiple
 * @param array $data
 *
 * @return null|string
 * @throws \yii\base\Exception
 * @throws \yii\base\InvalidConfigException
 */
function upload_img($form_name, $multiple = false, $data = [])
{
    $img = \thienhungho\MediaManagement\modules\uploads\UploadImgForm::upload($form_name, $multiple, $data);

    return $img;
}

/**
 * @param $size_name
 * @param $path
 *
 * @return mixed
 */
function get_other_img_size_path($size_name, $path)
{
    if ($size_name == 'raw') {
        return $path;
    }

    return \thienhungho\MediaManagement\modules\media\Media::getOtherSizePath($size_name, $path);
}

/**
 * @param $path
 */
function delete_media_path($path)
{
    $parent_path = dirname(dirname(Yii::getAlias('@app'))) . '/';
    @unlink($parent_path . $path);
    @unlink($parent_path . get_other_img_size_path('thumbnail', $path));
    @unlink($parent_path . get_other_img_size_path('medium', $path));
    @unlink($parent_path . get_other_img_size_path('large', $path));
}