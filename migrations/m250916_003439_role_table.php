<?php

use yii\db\Migration;

class m250916_003439_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%role}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $this->batchInsert('{{%role}}', ['name'], [
        ['user'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%role}}');
        $this->delete('{{%role}}', ['name' => ['user']]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250916_003439_role_table cannot be reverted.\n";

        return false;
    }
    */
}
