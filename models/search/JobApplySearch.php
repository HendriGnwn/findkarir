<?php

namespace app\models\search;

use app\models\JobApply;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * JobApplySearch represents the model behind the search form about `app\models\JobApply`.
 */
class JobApplySearch extends JobApply
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'job_id', 'user_id', 'review_by', 'review_counter', 'status', 'created_by', 'updated_by'], 'integer'],
            [['description', 'status_interview_at', 'status_updated_at', 'interview_at', 'venue', 'contact_person', 'contact_person_phone', 'created_at', 'updated_at'], 'safe'],
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
        $query = JobApply::find();

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

        $query->andFilterWhere([
            'id' => $this->id,
            'job_id' => $this->job_id,
            'user_id' => $this->user_id,
            'review_by' => $this->review_by,
            'review_counter' => $this->review_counter,
            'status' => $this->status,
            'status_interview_at' => $this->status_interview_at,
            'status_updated_at' => $this->status_updated_at,
            'interview_at' => $this->interview_at,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'venue', $this->venue])
            ->andFilterWhere(['like', 'contact_person', $this->contact_person])
            ->andFilterWhere(['like', 'contact_person_phone', $this->contact_person_phone]);

        return $dataProvider;
    }
}
