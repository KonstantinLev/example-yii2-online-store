<?php

use yii\db\Migration;

/**
 * Class m190620_135217_change_user
 */
class m190620_135217_change_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%users}}', 'username', $this->string());
        $this->alterColumn('{{%users}}', 'password_hash', $this->string());
        $this->alterColumn('{{%users}}', 'email', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%users}}', 'username', $this->string()->notNull());
        $this->alterColumn('{{%users}}', 'password_hash', $this->string()->notNull());
        $this->alterColumn('{{%users}}', 'email', $this->string()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190620_135217_change_user cannot be reverted.\n";

        return false;
    }
    */
}
