<?php

namespace thienhungho\MediaManagement\modules\MediaBase\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "media".
 *
 * @property integer $id
 * @property string $name
 * @property string $path
 * @property string $title
 * @property string $caption
 * @property string $alt
 * @property string $description
 * @property integer $file_size
 * @property string $dimensions
 * @property string $type
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Media extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'path'], 'required'],
            [['file_size', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'path', 'title', 'alt', 'dimensions', 'type', 'status'], 'string', 'max' => 255],
            [['caption', 'description'], 'string', 'max' => 550]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'media';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'path' => Yii::t('app', 'Path'),
            'title' => Yii::t('app', 'Title'),
            'caption' => Yii::t('app', 'Caption'),
            'alt' => Yii::t('app', 'Alt'),
            'description' => Yii::t('app', 'Description'),
            'file_size' => Yii::t('app', 'File Size'),
            'dimensions' => Yii::t('app', 'Dimensions'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }


    /**
     * @inheritdoc
     * @return \thienhungho\MediaManagement\modules\MediaBase\MediaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \thienhungho\MediaManagement\modules\MediaBase\MediaQuery(get_called_class());
    }
}
