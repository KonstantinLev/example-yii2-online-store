<?php

use yii\db\Migration;

/**
 * Class m190708_205748_add_product_modification
 */
class m190708_205748_add_product_modification extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%shop_modifications}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'price' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('{{%idx-shop_modifications-code}}', '{{%shop_modifications}}', 'code');
        $this->createIndex('{{%idx-shop_modifications-product_id-code}}', '{{%shop_modifications}}', ['product_id', 'code'], true);
        $this->createIndex('{{%idx-shop_modifications-product_id}}', '{{%shop_modifications}}', 'product_id');

        $this->addForeignKey('{{%fk-shop_modifications-product_id}}', '{{%shop_modifications}}', 'product_id', '{{%shop_products}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shop_modifications}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190708_205748_add_product_modification cannot be reverted.\n";

        return false;
    }
    */
}
