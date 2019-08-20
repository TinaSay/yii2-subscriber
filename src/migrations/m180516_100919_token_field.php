<?php

use yii\db\Migration;

/**
 * Class m180516_100919_token_field
 */
class m180516_100919_token_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%subscriber}}', 'token', $this->string(128)->notNull()->after('active'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%subscriber}}', 'token');
    }
}
