<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;

use app\models\Config;
use yii\web\Application as BaseApplication;

/**
 * Description of Application
 *
 * @author Hendri
 */
class Application extends BaseApplication
{
	public function init() {
		parent::init();
		
		$this->name = Config::getAppName();
		
		return true;
	}
    
    public function run() 
    {
        $this->view->registerMetaTag([
            'name' => 'google-site-verification',  
            'content' => '1-WO1CGauPMJEz_cuMPQe-YbfXmfyEJta2g33z0Avxk'
        ]);
        $this->view->registerMetaTag([
            'name' => 'msvalidate.01',  
            'content' => 'AEAF074EB5D345C076DDD01EE29E77E3'
        ]);
        
//        $configs = Config::getByNames([
//            'credential_googlemap_api',
//            'map_location_latitude',
//            'map_location_longitude',
//            'map_marker_description',
//        ]);
//        $configs['map_location_latitude'] = (float) $configs['map_location_latitude'];
//        $configs['map_location_longitude'] = (float) $configs['map_location_longitude'];
//
//        $this->params = ArrayHelper::merge($this->params, $configs);
        
        return parent::run();
    }
}
