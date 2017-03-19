<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        [
            'pattern' => 'sitemap', 
            'route' => 'site/sitemap', 
            'suffix' => '.xml'
        ],
        [
            'pattern' => '/',
            'route' => 'site/index',
        ],
        [
            'pattern' => 'jobs/listing',
            'route' => 'job/index',
        ],
        
        [
            'pattern' => 'user/skill',
            'route' => 'skill/index',
        ]
    ],
];