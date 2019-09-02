<?php
use \vendor\core\Router;

error_reporting(-1);

$query = rtrim($_SERVER['QUERY_STRING'], '/');

define('WWW', __DIR__);
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');
define('CORE', dirname(__DIR__) . '/vendor/core');
define('LAYOUT', 'default');
require '../vendor/libs/functions.php';

spl_autoload_register(function($class) {
    $file = ROOT . '/' . str_replace('\\s', '/', $class) . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});
// Пользоватеотские роуты
Router::add('^page/(?P<action>[[a-z-]+)/(?P<alias>[[a-z-]+)$', ['controller' => 'Page']);
Router::add('^page/(?P<alias>[[a-z-]+)$', ['controller' => 'Page', 'action' => 'view']);


// Дефолтные роуты
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[[a-z-]+)?$');

Router::dispatch($query);
