<?php

use yii\db\Migration;

/**
 * Class m210618_150934_post
 */
class m210618_150934_post extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }
    public function up()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'picture' => 'MEDIUMBLOB',
            'title' => $this->string(),
            'content' => $this->text(),
            'category' => $this->string()
        ]);

        $this->addForeignKey(
            'author_id',
            'post',
            'author_id',
            'user',
            'id',
            'CASCADE'
        );
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210618_150934_post cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210618_150934_post cannot be reverted.\n";

        return false;
    }
    */
}
