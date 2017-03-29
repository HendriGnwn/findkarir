<?php

namespace app\models\search;

use app\models\Company;
use app\models\Job;
use app\models\Order;
use app\models\Partner;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

/**
 * JobSearch represents the model behind the search form about `app\models\Job`.
 */
class JobSearch extends Job
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'job_type_id', 'city_id', 'province_id', 'salary_currency_id', 'status', 'status_payment', 'created_by', 'updated_by'], 'integer'],
            [['code', 'name', 'description', 'requirement', 'open_job_date', 'close_job_date', 'status_updated_at', 'status_payment_updated_at', 'created_at', 'updated_at'], 'safe'],
            [['start_salary', 'end_salary'], 'number'],
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
        $query = Job::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'open_job_date' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);
        
        $query->joinWith([
            'company' => function (ActiveQuery $query) {
                $query->andWhere(['company.status' => Company::STATUS_ACTIVE])
                    ->joinWith([
                        'partner' => function (ActiveQuery $query) {
                            $query->andWhere(['partner.status' => Partner::STATUS_ACTIVE])
                                ->joinWith([
                                    'orders o' => function (ActiveQuery $query) {
                                        $query->andWhere(['>=', 'o.offer_expired_at', date('Y-m-d')])
                                            ->andWhere(['o.status' => Order::STATUS_FREE_FOR_PARTNER])
                                            ->orderBy(['o.created_at' => SORT_DESC]);
                                    }
                                ]);
                        },
                    ]);
            }
        ]);
        
        $union = Job::find()->addSelect(['job.*', 'company_id' => 'o.offer_id'])->joinWith([
            'company' => function (ActiveQuery $query) {
                $query->andWhere(['company.status' => Company::STATUS_ACTIVE])
                    ->joinWith([
                        'user' => function (ActiveQuery $query) {
                            $query->joinWith([
                                'orders' => function (ActiveQuery $query) {
                                    $query->andWhere(['>=', 'order.offer_expired_at', date('Y-m-d')])
                                        ->andWhere(['order.status' => Order::STATUS_PAID])
                                        ->orderBy(['order.created_at' => SORT_DESC]);
                                }
                            ]);
                        }
                    ]);
            }
        ]);
        
        $query->union($union);
        
        $query->addSelect(['job.*', 'company_id' => 'o.offer_id']);
        
        $statusPayment = [Job::STATUS_PAYMENT_PAID, Job::STATUS_PAYMENT_FREE];
        $query->andWhere(['job.status' => Job::STATUS_ACTIVE]);
        $query->andWhere(['in', 'job.status_payment', $statusPayment]);
        
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'company_id' => $this->company_id,
//            'job_type_id' => $this->job_type_id,
//            'city_id' => $this->city_id,
//            'province_id' => $this->province_id,
//            'salary_currency_id' => $this->salary_currency_id,
//            'start_salary' => $this->start_salary,
//            'end_salary' => $this->end_salary,
//            'open_job_date' => $this->open_job_date,
//            'close_job_date' => $this->close_job_date,
//            'status' => $this->status,
//            'status_updated_at' => $this->status_updated_at,
//            'status_payment' => $this->status_payment,
//            'status_payment_updated_at' => $this->status_payment_updated_at,
//            'created_at' => $this->created_at,
//            'created_by' => $this->created_by,
//            'updated_at' => $this->updated_at,
//            'updated_by' => $this->updated_by,
//        ]);
//
//        $query->andFilterWhere(['like', 'code', $this->code])
//            ->andFilterWhere(['like', 'name', $this->name])
//            ->andFilterWhere(['like', 'description', $this->description])
//            ->andFilterWhere(['like', 'requirement', $this->requirement]);

        return $dataProvider;
    }
}
