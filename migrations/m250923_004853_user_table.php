<?php

use yii\db\Migration;

class m250923_004853_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'role_id'=> $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'age' => $this->integer(),
            'login' => $this->string()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-user-role_id', 
            '{{%user}}',      
            'role_id',           
            '{{%role}}',       
            'id',          
            'CASCADE',           
            'CASCADE'                
        );

        $roleId = (new \yii\db\Query())
            ->select('id')
            ->from('{{%role}}')
            ->scalar();

        $this->batchInsert('{{%user}}', ['role_id', 'name', 'age', 'login'], [
        [$roleId, 'Имя пользователя', '10','dfgdfs'],
    ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user-role_id', '{{%user}}');
        $this->delete('{{%user}}', ['name' => ['Имя пользователя']]);
        $this->dropTable('{{%user}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250916_002033_user_table cannot be reverted.\n";

        return false;
    }
    */
}
