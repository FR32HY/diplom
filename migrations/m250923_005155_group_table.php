<?php

use yii\db\Migration;

class m250923_005155_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%group}}', [
            'id' => $this->primaryKey(),
            'user_id'=> $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'maxSize' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-group-user_id', 
            '{{%group}}',       
            'user_id',         
            '{{%user}}',        
            'id',            
            'CASCADE',       
            'CASCADE'             
        );

        $userId = (new \yii\db\Query())
            ->select('id')
            ->from('{{%user}}')
            ->scalar();

        $this->batchInsert('{{%group}}', ['user_id', 'name', 'maxSize'], [
            [$userId, 'Кружок1', '15'],
    ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%group}}');
        $this->dropForeignKey('fk-group-user_id', '{{%group}}');
        $this->delete('{{%group}}', ['name' => ['Кружок1']]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250916_003215_group_table cannot be reverted.\n";

        return false;
    }
    */
}
