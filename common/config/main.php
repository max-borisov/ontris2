<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'mailer' => [
            'class' => 'common\components\mandrill\Mailer',
//            'useFileTransport' => true,
            'useFileTransport' => false,
            'viewPath' => '@common/mail',
            'fileTransportPath' => '@common/mail_output',
        ],
    ],
];
