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
        ],
        [
            'pattern' => 'user/skill/create',
            'route' => 'skill/create',
        ],
        [
            'pattern' => 'user/skill/delete/<id:\d+>',
            'route' => 'skill/delete',
        ],
        [
            'pattern' => 'user/passion',
            'route' => 'passion/index',
        ],
        [
            'pattern' => 'user/passion/create',
            'route' => 'passion/create',
        ],
        [
            'pattern' => 'user/passion/delete/<id:\d+>',
            'route' => 'passion/delete',
        ],
        [
            'pattern' => 'user/education',
            'route' => 'education/index',
        ],
        [
            'pattern' => 'user/education/create',
            'route' => 'education/create',
        ],
        [
            'pattern' => 'user/education/view/<id:\d+>',
            'route' => 'education/view',
        ],
        [
            'pattern' => 'user/education/update/<id:\d+>',
            'route' => 'education/update',
        ],
        [
            'pattern' => 'user/education/delete/<id:\d+>',
            'route' => 'education/delete',
        ],
        [
            'pattern' => 'user/dashboard',
            'route' => 'user-dashboard/index',
        ],
        [
            'pattern' => 'user/job-apply',
            'route' => 'user-dashboard/job-apply',
        ]
    ],
];