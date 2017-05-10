<?php

namespace app\modules\fkadmin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Company;

/**
 * CompanySearch represents the model behind the search form about `app\models\Company`.
 */
class CompanySearch extends Company
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'partner_id', 'city_id', 'province_id', 'status', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['code', 'name', 'address', 'latitude', 'longitude', 'phone', 'sector_area', 'employee_quantity', 'website', 'photo', 'description', 'created_at'], 'safe'],
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
    public function search($params, $filter = null)
    {
        $query = Company::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        
        if ($filter == 'user') {
            $query->andWhere(['partner_id' => null]);
        } else if ($filter == 'partner') {
            $query->andWhere(['user_id' => null]);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'partner_id' => $this->partner_id,
            'city_id' => $this->city_id,
            'province_id' => $this->province_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'latitude', $this->latitude])
            ->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'sector_area', $this->sector_area])
            ->andFilterWhere(['like', 'employee_quantity', $this->employee_quantity])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
