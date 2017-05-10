<?php

namespace app\models\queries;

use app\models\Job;
use app\models\Order;
use app\models\ViewJob;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\app\models\ViewJob]].
 *
 * @see ViewJob
 */
class ViewJobQuery extends ActiveQuery
{
    /**
     * @inheritdoc
     * @return ViewJob[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ViewJob|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    /**
     * @return $this
     */
    public function actived()
    {
        $this->andWhere(['status' => Job::STATUS_ACTIVE]);
        $this->andWhere(['<=', 'open_job_date', date('Y-m-d')]);
        $this->andWhere(['>=', 'close_job_date', date('Y-m-d')]);
        
        return $this;
    }
    
    /**
     * @return $this
     */
    public function ordered()
    {
        return $this->orderBy(['offer_order' => SORT_ASC, 'open_job_date' => SORT_DESC]);
    }
}
