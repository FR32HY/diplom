<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $full_name
 * @property string $phone
 * @property string|null $email
 * @property string|null $password_hash
 * @property string|null $role
 * @property string|null $created_at
 *
 * @property Registrations[] $registrations
 */
class Users extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password_hash'], 'default', 'value' => null],
            [['role'], 'default', 'value' => 'user'],
            [['full_name', 'phone'], 'required'],
            [['role'], 'string'],
            [['created_at'], 'safe'],
            [['full_name'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 50],
            [['password_hash'], 'string', 'max' => 255],
            ['role', 'in', 'range' => array_keys(self::optsRole())],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'role' => 'Role',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Registrations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegistrations()
    {
        return $this->hasMany(Registrations::class, ['user_id' => 'id']);
    }


    /**
     * column role ENUM value labels
     * @return string[]
     */
    public static function optsRole()
    {
        return [
            self::ROLE_USER => 'user',
            self::ROLE_ADMIN => 'admin',
        ];
    }

    /**
     * @return string
     */
    public function displayRole()
    {
        return self::optsRole()[$this->role];
    }

    /**
     * @return bool
     */
    public function isRoleUser()
    {
        return $this->role === self::ROLE_USER;
    }

    public function setRoleToUser()
    {
        $this->role = self::ROLE_USER;
    }

    /**
     * @return bool
     */
    public function isRoleAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function setRoleToAdmin()
    {
        $this->role = self::ROLE_ADMIN;
    }
}
