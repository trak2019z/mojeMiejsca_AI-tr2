<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    const SCENARIO_LOGGEDUSER = 'Kontakt dla użytkowników zalogowanych'; 
    const SCENARIO_GUESTUSER="Kontakt dla użytkowników niezalgowanych";

    /**
     * @return array the validation rules.
     */
    
    public function scenarios()
    {
        return [
            self::SCENARIO_LOGGEDUSER => ['name', 'email','subject','body'],
            self::SCENARIO_GUESTUSER => ['name', 'email','subject','body','verifyCode'],
        ];
    }
    
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required','message'=>'Pole nie może być puste.'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha','message'=>'Podaj prawidłowy kod captcha.']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Kod weryfikacyjny',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom($this->email)
                ->setSubject($this->subject)
                ->setTextBody("Wiadomość od: ".$this->name.", ".$this->email."\n\n".$this->body)
                ->send();

            return true;
        }
        return false;
    }
}
