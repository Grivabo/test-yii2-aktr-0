<?php
declare(strict_types = 1);

use yii\bootstrap5\LinkPager as LinkPagerBs5;
use yii\caching\FileCache;
use yii\debug\Module as ModuleDebug;
use yii\gii\Module as ModuleGii;
use yii\log\FileTarget;
use yii\symfonymailer\Mailer;
use yii\widgets\LinkPager;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$dbNGE = require __DIR__ . '/dbNGE.php';

$config = [
    'id' => 'basic',
    'name' => 'ТЗ backend v2 email',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'defaultRoute' => 'trips/index',
    'components' => [
        'request' => [
            'cookieValidationKey' => $_ENV['YII_COOKIE_VALIDATION_KEY'],
        ],
        'cache' => [
            'class' => FileCache::class,
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'dbNGE' => $dbNGE,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
    'container' => [
        'definitions' => [
            LinkPager::class => LinkPagerBs5::class,
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => ModuleDebug::class,
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => ModuleGii::class,
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '*'],
    ];
}

return $config;
