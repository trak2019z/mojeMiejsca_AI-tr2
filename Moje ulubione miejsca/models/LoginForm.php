<?php

namespace app\models;

use Yii;
use yii\base\Model;
use DateTime;
use DateTimeZone;
/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $ban;
    
    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required','message'=>'Pole nie może być puste'],
            // rememberMe must be a boolean value
            [['rememberMe'], 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Podano złą nazwę użytkownika lub hasło.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate() && $this->isNotBanned()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Uzytkownik::findByUsername($this->username);
        }

        return $this->_user;
    }
    
    public function lastLogin($userid) {
        
        $tz = 'Europe/Warsaw';
        $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone($tz)); 
        $dt->setTimestamp($timestamp);
        
        $user= Uzytkownik::findIdentity($userid);
        $user->scenario= Uzytkownik::SCENARIO_LASTLOGINUPDATE;
        $user->last_login=$dt->format('Y-m-d H:i:s');
        $user->save();
    }
    
    
    
    public function isNotBanned() {
            $user = Uzytkownik::findByUsername($this->username);
            if(!is_null($user) && $user->ban==false) {
                return true;
            }
            else {
                $this->addError('username', 'Konto nie zostało aktywowane. Sprawdź pocztę e-mail.');
                return false;
            }

    }
    
    
}
