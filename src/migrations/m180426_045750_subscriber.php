<?php

use yii\db\Migration;

/**
 * Class m180426_045750_subscriber
 */
class m180426_045750_subscriber extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;
        $this->createTable('{{%subscriber}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string(64)->notNull()->unique(),
            'country' => $this->string(128)->null()->defaultValue(null),
            'city' => $this->string(128)->null()->defaultValue(null),
            'coordinates' => $this->string(128)->null()->defaultValue(null),
            'ip' => $this->bigInteger(20)->null()->defaultValue(null),
            'link' => $this->string(256)->null()->defaultValue(null),
            'blocked' => $this->smallInteger(1)->notNull()->defaultValue(0),
            'createdAt' => $this->datetime()->null()->defaultValue(null),
            'updatedAt' => $this->dateTime()->null()->defaultValue(null),
        ], $options);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%subscriber}}');
    }
}
