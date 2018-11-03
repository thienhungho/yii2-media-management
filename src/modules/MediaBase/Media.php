<?php

namespace thienhungho\MediaManagement\modules\MediaBase;

use Yii;
use \thienhungho\MediaManagement\modules\MediaBase\base\Media as BaseMedia;

/**
 * This is the model class for table "media".
 */
class Media extends BaseMedia
{
    const STATUS_PUBLIC = 'public';
    const STATUS_PENDING = 'pending';
    const STATUS_DRAFT = 'draft';
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name', 'path'], 'required'],
            [['file_size', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'path', 'title', 'alt', 'dimensions', 'type', 'status'], 'string', 'max' => 255],
            [['caption', 'description'], 'string', 'max' => 550],
            [['status'], 'default', 'value' => self::STATUS_PUBLIC],
        ]);
    }

    /**
     * @param $size_name
     * @param $path
     *
     * @return mixed
     */
    public static function getOtherSizePath($size_name ,$path)
    {
        return str_replace("uploads",'uploads/'. $size_name, $path);
    }
}
