<?php
declare(strict_types=1);

use yii\caching\FileCache;
use yii\debug\Module as ModuleDebug;
use yii\gii\Module as ModuleGii;
use yii\log\FileTarget;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$dbNGE = require __DIR__ . '/dbNGE.php';

$config = [
	'id' => 'basic-console',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],
	'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
        'cache' => [
			'class' => FileCache::class,
		],
		'log' => [
			'targets' => [
				[
					'class' => FileTarget::class,
					'levels' => ['error', 'warning'],
				],
			],
		],
		'db' => $db,
		'dbNGE' => $dbNGE,
	],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
		'class' => ModuleGii::class,
	];
    // configuration adjustments for 'dev' environment
    // requires version `2.1.21` of yii2-debug module
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
		'class' => ModuleDebug::class,
		// uncomment the following to add your IP if you are not connecting from localhost.
		//'allowedIPs' => ['127.0.0.1', '::1'],
	];
}

return $config;
