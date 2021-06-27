<?php

use yii\db\Migration;

/**
 * Class m210618_150922_user
 */
class m210618_150922_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(30)->notNull(),
            'password' => $this->string(100),
            'auth_key' => $this->string(),
            'access_token' => $this->string()
        ]);
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210618_150922_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210618_150922_user cannot be reverted.\n";

        return false;
    }
    */
}
