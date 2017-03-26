<?php

namespace app\modules\fkadmin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * OrderSearch represents the model behind the search form about `app\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'partner_id', 'offer_id', 'status', 'currency_id', 'created_by', 'updated_by'], 'integer'],
            [['offer_at', 'code', 'description', 'offer_expired_at', 'status_updated_at', 'status_paid_at', 'status_expired_at', 'created_at', 'updated_at'], 'safe'],
            [['amount', 'admin_fee', 'final_amount'], 'number'],
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
     * @param \yii\db\ActiveQuery $query
     * @return \yii\db\ActiveQuery
     */
    protected function filterQuerySearch(\yii\db\ActiveQuery $query)
    {
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'partner_id' => $this->partner_id,
            'offer_id' => $this->offer_id,
            'offer_at' => $this->offer_at,
            'offer_expired_at' => $this->offer_expired_at,
            'status' => $this->status,
            'status_updated_at' => $this->status_updated_at,
            'status_paid_at' => $this->status_paid_at,
            'status_expired_at' => $this->status_expired_at,
            'currency_id' => $this->currency_id,
            'amount' => $this->amount,
            'admin_fee' => $this->admin_fee,
            'final_amount' => $this->final_amount,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'description', $this->description]);
        
        return $query;
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
        $query = Order::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query = $this->filterQuerySearch($query);

        return $dataProvider;
    }
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchUser($params)
    {
        $query = Order::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);
        
        $query->andWhere(['partner_id' => null]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query = $this->filterQuerySearch($query);

        return $dataProvider;
    }
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchPartner($params)
    {
        $query = Order::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);
        
        $query->andWhere(['user_id' => null]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query = $this->filterQuerySearch($query);

        return $dataProvider;
    }
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchConfirmation($params)
    {
        $query = Order::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);
        
        $query->andWhere(['status' => Order::STATUS_CONFIRMED_BY_USER]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query = $this->filterQuerySearch($query);

        return $dataProvider;
    }
}
