<?php

use yii\db\Migration;

class m250916_010048_lesson_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lesson}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'price' => $this->integer(),
        ]);

        $this->batchInsert('{{%lesson}}', ['name', 'price'], [
        ['Танцы', '300'],
    ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%lesson}}');
        $this->delete('{{%lesson}}', ['name' => ['Танцы']]);
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250916_010048_lesson_table cannot be reverted.\n";

        return false;
    }
    */
}
