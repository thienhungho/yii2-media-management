<?php

namespace thienhungho\MediaManagement\modules\media;

/**
 * This is the ActiveQuery class for [[Media]].
 *
 * @see Media
 */
class MediaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Media[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Media|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
