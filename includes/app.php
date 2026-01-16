<?php 

require __DIR__ . '/../vendor/autoload.php';

use \App\Utils\View;
use \App\DotEnv\Environment;
use \App\Db\Database;
USE \App\Http\Middleware\Queue as MiddlewareQueue; 

Environment::load(__DIR__ . '/../');

Database::config(
    getenv('DB_HOST'),
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_PORT')
);

define('URL', getenv('URL'));

View::init([
    'URL' => URL
]);

MiddlewareQueue::setMap([
    'maintenance'           => \App\Http\Middleware\Maintenance::class,
    'required-common-login' => \App\Http\Middleware\RequireCommonLogin::class,
    'required-common-logout' => \App\Http\Middleware\RequireCommonLogout::class,
    'permission-check'      => \App\Http\Middleware\PermissionCheck::class
]);
MiddlewareQueue::setDefault([
    'maintenance',
    'permission-check'
]);