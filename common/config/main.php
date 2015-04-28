<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'en-US',
//    'language' => 'da-DA',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'mailer' => [
            'class' => 'common\components\mandrill\Mailer',
            'useFileTransport' => true,
//            'useFileTransport' => false,
            'viewPath' => '@common/mail',
            'fileTransportPath' => '@common/mail_output',
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'en',
                ],
            ],
        ],
    ],
];
