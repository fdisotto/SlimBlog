<?php
session_save_path(sys_get_temp_dir());
session_start();

defined("EXEC") or define("EXEC", true);
defined("DS") or define("DS", DIRECTORY_SEPARATOR);
defined("ROOT") or define("ROOT", dirname(dirname(__DIR__)));

defined("APP") or define("APP", ROOT . DS . "app");
defined("BOOT") or define("BOOT", APP . DS . "boot");
defined("TEMPLATES") or define("TEMPLATES", APP . DS . "templates");
defined("LANGUAGES") or define("LANGUAGES", APP . DS . "languages");
defined("STORAGE") or define("STORAGE", ROOT . DS . "storage");
defined("CACHE") or define("CACHE", STORAGE . DS . "cache");
defined("VENDOR") or define("VENDOR", ROOT . DS . "vendor");

require VENDOR . DS . 'autoload.php';

$settings = require APP . DS . 'settings.php';
$app = new Slim\App($settings);

require APP . DS . 'dependencies.php';

require APP . DS . 'middleware.php';

require APP . DS . 'routes.php';
