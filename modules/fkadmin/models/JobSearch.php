<?php

namespace app\modules\fkadmin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Job;

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
        ]);

        $this->load($params);
        
        $query->orderBy(['status' => SORT_ASC, 'status_payment' => SORT_ASC]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'company_id' => $this->company_id,
            'job_type_id' => $this->job_type_id,
            'city_id' => $this->city_id,
            'province_id' => $this->province_id,
            'salary_currency_id' => $this->salary_currency_id,
            'start_salary' => $this->start_salary,
            'end_salary' => $this->end_salary,
            'open_job_date' => $this->open_job_date,
            'close_job_date' => $this->close_job_date,
            'status' => $this->status,
            'status_updated_at' => $this->status_updated_at,
            'status_payment' => $this->status_payment,
            'status_payment_updated_at' => $this->status_payment_updated_at,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'requirement', $this->requirement]);

        return $dataProvider;
    }
}
