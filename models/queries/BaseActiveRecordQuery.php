<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models\queries;

use app\models\BaseActiveRecord;
use app\models\Job;
use yii\db\ActiveQuery;

/**
 * Description of BaseActiveRecordQuery
 *
 * @author Hendri
 */
class BaseActiveRecordQuery extends ActiveQuery
{	
	/**
	 * order by created_at sort desc
	 * 
	 * @param type $sort by default is sort desc
	 * @return type
	 */
	public function orderCreatedAt($sort = SORT_DESC)
	{
		return $this->orderBy(['created_at' => $sort]);
	}
	
	/**
	 * status is active
	 * 
	 * @return query
	 */
	public function actived()
	{
		return $this->andWhere([
			'status' => BaseActiveRecord::STATUS_ACTIVE,
		]);
	}
    
    /**
     * @return query
     */
    public function ordered()
    {
        return $this->orderBy([
            'order' => SORT_ASC,
        ]);
    }
    
    /**
     * function khusus untuk job
     * 
     * @return $this
     */
    public function jobPublished()
    {
        $this->andWhere([
            'status' => BaseActiveRecord::STATUS_ACTIVE,
        ]);
        
        $this->andWhere(['in', 'status_payment', [Job::STATUS_PAYMENT_PAID, Job::STATUS_PAYMENT_FREE]]);
        
        return $this;
    }
	
}
