<?php
$app->add(new \Slim\Middleware\SessionCookie(array('secret' => 'h5/4jc/)$3kfè4()487HD3d')));

// Make a new connection
use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection(array(
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'slimblog',
    'username' => 'root',
    'password' => '',
    'prefix' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_general_ci',
));
$capsule->bootEloquent();
$capsule->setAsGlobal();

$app->db = $capsule;

/**
 * Extract settings from db
 */
$settings = Settings::where('id', '=', 1)->first();

/**
 * Set template directory
 */
$app->config(array(
    "templates.path" => TEMPLATEDIR . $settings->template . DS,
));

use dflydev\markdown\MarkdownParser;

$app->container->singleton('markdown', function () {
    return new MarkdownParser();
});

foreach (glob(ROOT . 'libs' . DS . '*.php') as $filename) {
    require_once $filename;
}