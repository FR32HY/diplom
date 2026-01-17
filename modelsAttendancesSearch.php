<?php

namespace app;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Attendances;

/**
 * modelsAttendancesSearch represents the model behind the search form of `app\models\Attendances`.
 */
class modelsAttendancesSearch extends Attendances
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'registration_id', 'is_present'], 'integer'],
            [['date', 'notes'], 'safe'],
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Attendances::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_id' => $this->registration_id,
            'date' => $this->date,
            'is_present' => $this->is_present,
        ]);

        $query->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
