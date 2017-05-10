<?php

namespace app\modules\fkadmin\models;

use dektrium\user\models\UserSearch as BaseUserSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * Description of UserSearch
 *
 * @author acer
 */
class UserSearch extends BaseUserSearch
{
    public $category;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['category'], 'safe'],
        ]);
    }
    
    /**
     * @param $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = $this->finder->getUserQuery();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($this->created_at !== null) {
            $date = strtotime($this->created_at);
            $query->andFilterWhere(['between', 'created_at', $date, $date + 3600 * 24]);
        }
        
        $query->andFilterWhere([
            'category' => $this->category,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['registration_ip' => $this->registration_ip]);

        return $dataProvider;
    }
}
