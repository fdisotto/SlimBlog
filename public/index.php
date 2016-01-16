<?php
if (PHP_SAPI == 'cli-server') {
    $file = __DIR__ . $_SERVER['REQUEST_URI'];
    if (is_file($file)) {
        return false;
    }
}

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_save_path(sys_get_temp_dir());
session_start();

defined("EXEC") or define("EXEC", true);
defined("DS") or define("DS", DIRECTORY_SEPARATOR);
defined("ROOT") or define("ROOT", realpath(dirname(__DIR__)));

defined("APP") or define("APP", ROOT . "/app");

defined("VENDOR") or define("VENDOR", ROOT . "/vendor");
defined("STORAGE") or define("STORAGE", ROOT . "/storage");

defined("CONFIG") or define("CONFIG", APP . "/config");
defined("LANGUAGE") or define("LANGUAGE", APP . "/language");
defined("VIEWS") or define("VIEWS", APP . "/views");

defined("DATABASE") or define("DATABASE", STORAGE . "/database");
defined("CACHE") or define("CACHE", STORAGE . "/cache");
defined("LOGS") or define("LOGS", STORAGE . "/logs");

require VENDOR . '/autoload.php';

$settings = require APP . '/settings.php';
$app = new Slim\App($settings);

require APP . '/dependencies.php';

require APP . '/middleware.php';

require APP . '/routes.php';

$app->run();