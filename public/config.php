<?php
$app->add(new \Slim\Middleware\SessionCookie(array('secret' => 'h5/4jc/)$3kfè4()487HD3d')));

// Make a new connection
use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection(include ROOT . "config" . DS . 'database.config.php');
$capsule->bootEloquent();
$capsule->setAsGlobal();

$app->db = $capsule;

/**
 * Extract settings from db
 */
$settings = Settings::where('id', '=', 1)->first();
$settings->base_url = $app->request->getUrl() . $app->request->getScriptName();

/**
 * Set template directory
 */
$app->config(array(
    "templates.path" => TEMPLATEDIR . $settings->template . DS,
));

/**
 * Add some twig extensions for multilanguage support
 */
$app->view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
    new Twig_Extension_StringLoader()
);

/**
 * Get language
 */
$app->lang = require_once LANGUAGEDIR . $settings->language . ".php";

/**
 * Markdown support
 */
$app->container->singleton('markdown', function () {
    return Parsedown::instance();
});

/**
 * Load all libs
 */
foreach (glob(ROOT . 'libs' . DS . '*.php') as $filename) {
    require_once $filename;
}