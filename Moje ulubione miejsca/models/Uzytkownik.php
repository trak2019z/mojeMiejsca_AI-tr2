<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "uzytkownik".
 *
 * @property int $user_id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $created_on
 * @property string $last_login
 * @property bool $ban
 * @property string $regcode
 */
class Uzytkownik extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uzytkownik';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_on', 'last_login'], 'safe'],
            [['ban'], 'boolean'],
            [['username', 'password'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 255],
            [['regcode'], 'string', 'max' => 32],
            [['email'], 'unique'],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'created_on' => 'Created On',
            'last_login' => 'Last Login',
            'ban' => 'Ban',
            'regcode' => 'Regcode',
        ];
    }
    
}
