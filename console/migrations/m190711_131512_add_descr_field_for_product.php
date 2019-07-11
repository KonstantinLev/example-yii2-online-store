<?php

use yii\db\Migration;

/**
 * Class m190711_131512_add_descr_field_for_product
 */
class m190711_131512_add_descr_field_for_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%shop_products}}', 'description', $this->text()->after('name'));
        $this->addColumn('{{%shop_products}}', 'status', $this->smallInteger()->notNull());
        $this->update('{{%shop_products}}', ['status' => 1]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%shop_products}}', 'description');
        $this->dropColumn('{{%shop_products}}', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190711_131512_add_descr_field_for_product cannot be reverted.\n";

        return false;
    }
    */
}
