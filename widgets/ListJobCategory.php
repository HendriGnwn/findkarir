<?php

namespace app\widgets;

use yii\bootstrap\Widget;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ListJobCategory extends Widget
{
    public function run()
    {
        return $this->render('list-job-category');
    }
}