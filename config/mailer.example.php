<?php

return [
    'class' => 'zyx\phpmailer\Mailer',
    'viewPath' => '@app/mail',
    'useFileTransport' => true, // change false to real sending email
    'config' => [
        'mailer' => '',
        'host' => '',
        'port' => '',
        'smtpsecure' => '',
        'smtpauth' => true,
        'username' => '',
        'password' => '',
    ],
];
