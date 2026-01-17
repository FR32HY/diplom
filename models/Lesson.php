<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lesson".
 *
 * @property int $id
 * @property string $name
 * @property int|null $price
 *
 * @property Schedule[] $schedules
 */
class Lesson extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lesson';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price'], 'default', 'value' => null],
            [['name'], 'required'],
            [['price'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[Schedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedule::class, ['lesson_id' => 'id']);
    }

}
