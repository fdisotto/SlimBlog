<?php
require_once "../vendor/autoload.php";

$app = new \Slim\Slim(array(
    "view" => new \Slim\Extras\Views\Twig(),
    "templates.path" => "../templates/",
    "mode" => "development",
));

require_once 'config.php';

require_once 'routes.php';

$app->run();