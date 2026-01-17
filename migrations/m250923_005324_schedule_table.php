<?php

use yii\db\Migration;

class m250923_005324_schedule_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%schedule}}', [
            'id' => $this->primaryKey(),
            'lesson_id' => $this->integer(),
            'group_id'=> $this->integer(),
            'dateStart' => $this->date(),
            'dateEnd' => $this->date(),
        ]);

        // добавляем внешний ключ
        $this->addForeignKey(
            'fk-schedule-lesson_id',
            '{{%schedule}}',        
            'lesson_id',            
            '{{%lesson}}',         
            'id',                
            'CASCADE',                
            'CASCADE'           
        );

        $this->addForeignKey(
            'fk-schedule-group_id', 
            '{{%schedule}}',       
            'group_id',           
            '{{%group}}',     
            'id',            
            'CASCADE',         
            'CASCADE'          
        );

        $lessonId = (new \yii\db\Query())
            ->select('id')
            ->from('{{%lesson}}')
            ->scalar();

        $groupId = (new \yii\db\Query())
            ->select('id')
            ->from('{{%group}}')
            ->scalar();

        $this->batchInsert('{{%schedule}}', ['lesson_id', 'group_id', 'dateStart', 'dateEnd'], [
            [$lessonId, $groupId, '2025-01-01', '2025-02-01'],
    ]);
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-schedule-lesson_id', '{{%schedule}}');
        $this->dropForeignKey('fk-schedule-group_id', '{{%schedule}}');
        $this->delete('{{%schedule}}', ['dateStart' => ['01.01.2025']]);
        $this->dropTable('{{%schedule}}');
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250916_002821_schedule_table cannot be reverted.\n";

        return false;
    }
    */
}
