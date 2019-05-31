<?php
 
namespace app\models;

//use Yii;

/**
 * This is the model class for table "places".
 *
 * @property int $id
 * @property int $ownerid
 * @property string $name
 * @property double $latitude
 * @property double $longitude
 * @property string $text
 * @property string $link
 * @property int $grade
 * @property bool $public
 */
class Places extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'places';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ownerid'], 'default', 'value' => null],
            [['ownerid','grade'], 'integer'],
            [['public'],'boolean'],
            [['latitude', 'longitude'], 'number'],
            [['text', 'link','name'], 'string', 'max' => 355],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'ownerid' => 'Id właściciela',
            'latitude' => 'Długość geograficzna',
            'longitude' => 'Szerokość geograficzna',
            'text' => 'Opis',
            'link' => 'Link do strony',
            'name'=> 'Nazwa',
            'grade'=>'Ocena',
            'public'=>'Upublicznij wpis'
        ];
    }
}
