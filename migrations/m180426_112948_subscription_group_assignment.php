<?php

use yii\db\Migration;

/**
 * Class m180426_112948_group_assignment
 */
class m180426_112948_subscription_group_assignment extends Migration
{
    /**
     * @return bool|void
     */
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;
        $this->createTable('{{%subscription_group_assignment}}', [
            'id' => $this->primaryKey(),
            'subscriberId' => $this->integer(11)->notNull(),
            'groupId' => $this->integer(11)->notNull(),
        ], $options);

        $this->addForeignKey(
            'group_assignment_subscriberId_subscriberId',
            '{{%subscription_group_assignment}}',
            'subscriberId',
            '{{%subscriber}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->addForeignKey(
            'group_assignment_groupId_subscription_groupId',
            '{{%subscription_group_assignment}}',
            'groupId',
            '{{%subscription_group}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * @return bool|void
     */
    public function safeDown()
    {
        $this->dropForeignKey('group_assignment_groupId_subscription_groupId', '{{%subscription_group_assignment}}');
        $this->dropForeignKey('group_assignment_subscriberId_subscriberId', '{{%subscription_group_assignment}}');
        $this->dropTable('{{%subscription_group_assignment}}');
    }
}
