<?php

namespace app\modules\fkadmin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Currency;

/**
 * CurrencySearch represents the model behind the search form about `app\models\Currency`.
 */
class CurrencySearch extends Currency
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order'], 'integer'],
            [['code', 'name', 'symbol'], 'safe'],
            [['rate'], 'number'],
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
        $query = Currency::find();

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
            'rate' => $this->rate,
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'symbol', $this->symbol]);

        return $dataProvider;
    }
}
