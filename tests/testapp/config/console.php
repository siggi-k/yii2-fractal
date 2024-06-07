<?php
return [
    'id' => 'fractal-cli',
    'timeZone' => 'UTC',
    'basePath' => dirname(__DIR__),
    'runtimePath' => dirname(__DIR__) . '/runtime',
    'vendorPath' => dirname(__DIR__, 3) . '/vendor',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    //'bootstrap'=>['log'],
    'controllerMap' => [
        'migrate' => [
            'class' => \yii\console\controllers\MigrateController::class,
            'migrationPath' => dirname(__DIR__).'/migrations',
        ],
    ],
    'components' => [
        'db'=>[
            'class' => \yii\db\Connection::class,
            'dsn' => 'pgsql:host=pgsql;dbname=testdb',
            'username' => 'dbuser',
            'password' => 'dbpass',
            'charset' => 'utf8',
        ],
        'log' => [
            'traceLevel' => 3,
            'targets' => [
                [
                    'class' => yii\log\FileTarget::class,
                    'logFile' => '/tmp/yii2-fractal-test-error.log',
                    'logVars' => ['_GET', '_POST']
                ],
            ],
        ],
    ],
];
