<?php
return [
    'language' => 'es_MX',
    'sourceLanguage' => 'es_MX',
    'name' => 'Seguimiento Pendientes Gabinete',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'rbac' => 'dektrium\rbac\RbacWebModule',
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            //'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['jgranados','esaul']
        ],
    ],
    'components' => [
        'authManager' => [
        'class' => 'dektrium\rbac\components\DbManager',
    ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
