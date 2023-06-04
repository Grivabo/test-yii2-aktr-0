<?php
declare(strict_types=1);

use yii\db\Connection;

return [
	'class' => Connection::class,
	'dsn' => 'mysql:host=mysql;dbname=cbt',
	'username' => 'root',
	'password' => $_ENV['MYSQL_ROOT_PASSWORD'],
	'charset' => 'utf8',

	// Schema cache options (for production environment)
	//'enableSchemaCache' => true,
	//'schemaCacheDuration' => 60,
	//'schemaCache' => 'cache',
];
