<?php

namespace app\models\search;

use app\models\Passion;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PassionSearch represents the model behind the search form about `app\models\Passion`.
 */
class PassionSearch extends Passion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'job_type_id', 'user_id'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Passion::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'job_type_id' => $this->job_type_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
        ]);

        return $dataProvider;
    }
}
