<?php

use yii\db\Migration;

/**
 * Class m190711_130126_add_main_photo_for_product
 */
class m190711_130126_add_main_photo_for_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%shop_products}}', 'main_photo_id', $this->integer());

        $this->createIndex('{{%idx-shop_products-main_photo_id}}', '{{%shop_products}}', 'main_photo_id');

        $this->addForeignKey('{{%fk-shop_products-main_photo_id}}', '{{%shop_products}}', 'main_photo_id', '{{%shop_photos}}', 'id', 'SET NULL', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-shop_products-main_photo_id}}', '{{%shop_products}}');

        $this->dropColumn('{{%shop_products}}', 'main_photo_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190711_130126_add_main_photo_for_product cannot be reverted.\n";

        return false;
    }
    */
}
