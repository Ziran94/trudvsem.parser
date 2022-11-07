<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contacts;

/**
 * ContactsSearch represents the model behind the search form of `app\models\Contacts`.
 */
class ContactsSearch extends Contacts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idResume', 'fio', 'positionName', 'phone', 'email', 'genderType', 'demands'], 'safe'],
            [['age', 'salary', 'idRegion', 'firstPublishedDate', 'publishedDate', 'status'], 'integer'],
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
        $query = Contacts::find();

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
            'age' => $this->age,
            'salary' => $this->salary,
            'idRegion' => $this->idRegion,
            'firstPublishedDate' => $this->firstPublishedDate,
            'publishedDate' => $this->publishedDate,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'idResume', $this->idResume])
            ->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'positionName', $this->positionName])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'genderType', $this->genderType])
            ->andFilterWhere(['like', 'demands', $this->demands]);

        return $dataProvider;
    }
}
