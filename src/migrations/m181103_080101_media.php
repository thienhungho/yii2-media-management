<?php

namespace thienhungho\MediaManagement\migrations;

use yii\db\Schema;

class m181103_080101_media extends \yii\db\Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%media}}', [
            'id'          => $this->primaryKey(),
            'name'        => $this->string(255)->notNull(),
            'path'        => $this->string(255)->notNull(),
            'title'       => $this->string(255),
            'caption'     => $this->string(550),
            'alt'         => $this->string(255),
            'description' => $this->string(550),
            'file_size'   => $this->integer(19),
            'dimensions'  => $this->string(255),
            'type'        => $this->string(255)->defaultValue('image/png'),
            'status'      => $this->string(255)->defaultValue('public'),
            'created_at'  => $this->timestamp()->notNull()->defaultValue(CURRENT_TIMESTAMP),
            'updated_at'  => $this->timestamp()->notNull()->defaultValue('0000-00-00 00:00:00'),
            'created_by'  => $this->integer(19),
            'updated_by'  => $this->integer(19),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%media}}');
    }
}
