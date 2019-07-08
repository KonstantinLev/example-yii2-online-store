<?php

use yii\db\Migration;

/**
 * Class m190708_204452_add_related_assignments
 */
class m190708_204452_add_related_assignments extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%shop_related_assignments}}', [
            'product_id' => $this->integer()->notNull(),
            'related_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%pk-shop_related_assignments}}', '{{%shop_related_assignments}}', ['product_id', 'related_id']);

        $this->createIndex('{{%idx-shop_related_assignments-product_id}}', '{{%shop_related_assignments}}', 'product_id');
        $this->createIndex('{{%idx-shop_related_assignments-related_id}}', '{{%shop_related_assignments}}', 'related_id');

        $this->addForeignKey('{{%fk-shop_related_assignments-product_id}}', '{{%shop_related_assignments}}', 'product_id', '{{%shop_products}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-shop_related_assignments-related_id}}', '{{%shop_related_assignments}}', 'related_id', '{{%shop_products}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shop_related_assignments}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190708_204452_add_related_assignments cannot be reverted.\n";

        return false;
    }
    */
}
