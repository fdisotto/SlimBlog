<?php
// Only invoked if mode is "production"
$app->configureMode('production', function () use ($app) {
    $app->config(array(
        'log.enable' => true,
        'debug' => false
    ));
});

// Only invoked if mode is "development"
$app->configureMode('development', function () use ($app) {
    $app->config(array(
        'log.enable' => false,
        'debug' => true
    ));
});

$app->add(new \Slim\Middleware\SessionCookie(array('secret' => 'h5/4jc/)$3kfè4()487HD3d')));

// Make a new connection
use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection(array(
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'slimblog',
    'username' => 'root',
    'password' => '090190',
    'prefix' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_general_ci',
));
$capsule->bootEloquent();
$capsule->setAsGlobal();

$app->db = $capsule;

$settings = Settings::where('id', '=', 1)->first();

use dflydev\markdown\MarkdownParser;

$app->container->singleton('markdown', function () {
    return new MarkdownParser();
});
