<?php
 
namespace app\models;

//use Yii;

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
class Uzytkownik extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public $verifyCode, $password2, $email2;
    
    const SCENARIO_UPDATE = 'Update'; 
    const SCENARIO_LASTLOGINUPDATE="Last login date update";
    const SCENARIO_REGISTRATION="User registrarion";
    
    public function scenarios()
    {
        return [
            self::SCENARIO_UPDATE => ['email', 'password','user_id'],
            self::SCENARIO_LASTLOGINUPDATE => ['last_login','user_id'],
            self::SCENARIO_REGISTRATION => ['username', 'password', 'email', 'created_on', 
                                        'ban','email2','password2','verifyCode','regcode']
        ];
    }
    
    
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
            [['username', 'password', 'email', 'created_on', 'ban','email2','password2'], 'required','message'=>'Pole nie może być puste'],
            [['created_on', 'last_login'], 'safe'],
            [['ban'], 'boolean'],
            [['username', 'password','password2','regcode'], 'string', 'max' => 50],
            [['email','email2'], 'string', 'max' => 255],
            [['email','email2'],'email','message'=>'Podaj prawidłowy adres e-mail.'],
            [['email','regcode','username'], 'unique'],
            ['email2','compare','compareAttribute'=>'email','operator'=>'===','message'=>'Pola adresu e-mail muszą być takie same'],
            ['password2','compare','compareAttribute'=>'password','operator'=>'===','message'=>'Hasła muszą być takie same'],
            ['verifyCode', 'captcha','message'=>'Podaj kod weryfikacyjny'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'Numer ID użytkownika',
            'username' => 'Nazwa użytkownika',
            'password' => 'Hasło',
            'password2'=>'Powtórz hasło',
            'email' => 'Adres e-mail',
            'email2'=>'Powtórz adres e-mail',
            'created_on' => 'Data i godzina utworzenia konta',
            'last_login' => 'Data i godzina ostatniego logowania',
            'ban' => 'Zablokowane',
            'verifyCode'=>'Kod weryfikacyjny',
            'regcode'=>'Kod aktywacyjny'
        ];
    }

    public function getAuthKey(): string {
        return $this->user_id;
    }

    public function getId() {
        return $this->user_id;
    }

    public function validateAuthKey($authKey): bool {
        return $this->user_id === $authKey;
    }

    public static function findIdentity($id): \yii\web\IdentityInterface {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null): \yii\web\IdentityInterface {
        throw new \yii\base\NotSupportedException;
    }
    
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }
    
    public static function findByUsername($username)
    {
        return self::findOne(['username'=>$username]);
    }
    
}
