<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Places;

/**
 * PlacesSearch represents the model behind the search form of `app\models\Places`.
 */
class PlacesSearch extends Places
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ownerid','grade'], 'integer'],
            [['public'],'boolean'],
            [['latitude', 'longitude'], 'number'],
            [['text', 'link','name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Places::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ownerid' => $this->ownerid,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'name'=> $this->name,
            'grade'=> $this->grade,
            'public'=> $this->public
        ]);

        $query->andFilterWhere(['ilike', 'text', $this->text])
            ->andFilterWhere(['ilike', 'link', $this->link])
            ->andFilterWhere(['ilike', 'name', $this->name]);

        return $dataProvider;
    }
}
