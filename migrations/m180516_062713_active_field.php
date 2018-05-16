<?php

use yii\db\Migration;

/**
 * Class m180516_062713_active_field
 */
class m180516_062713_active_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%subscriber}}', 'active',
            $this->smallInteger(1)->defaultValue(1)->notNull()->after('blocked'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%subscriber}}', 'active');
    }
}
