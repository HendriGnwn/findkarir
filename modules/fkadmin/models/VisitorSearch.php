<?php

namespace app\modules\fkadmin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Visitor;

/**
 * VisitorSearch represents the model behind the search form about `app\models\Visitor`.
 */
class VisitorSearch extends Visitor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'quantity', 'is_real'], 'integer'],
            [['date'], 'safe'],
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
        $query = Visitor::find();

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
            'quantity' => $this->quantity,
            'date' => $this->date,
            'is_real' => $this->is_real,
        ]);

        return $dataProvider;
    }
}
