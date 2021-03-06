<?php

use yii\db\Migration;

/**
 * Class m180426_104206_subscription_group
 */
class m180426_104206_subscription_group extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;
        $this->createTable('{{%subscription_group}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(64)->notNull()->unique(),
            'hidden' => $this->smallInteger(1)->notNull()->defaultValue(0),
            'language' => $this->string(8)->notNull(),
            'createdAt' => $this->dateTime()->notNull()->defaultValue(null),
            'updatedAt' => $this->dateTime()->null()->defaultValue(null),
        ], $options);

        $this->createIndex('titleLanguage', '{{%subscription_group}}', ['title', 'language'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%subscription_group}}');
    }
}
