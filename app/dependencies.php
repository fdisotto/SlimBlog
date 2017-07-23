<?php
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Component\Translation\Loader\PhpFileLoader;
use Symfony\Component\Translation\MessageSelector;
use Symfony\Component\Translation\Translator;

$container = $app->getContainer();

//Database
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();


//Site settings
$container['site_settings'] = function ($c) {
    $res = \App\Models\Settings::all()->toArray();

    $settings = [];
    foreach ($res as $r) {
        $settings[$r['key']] = $r['value'];
    }

    return $settings;
};

// Translator
$container['translator'] = function ($c) {
    $site_settings = $c->get('site_settings');

    $translator = new Translator($site_settings['language'], new MessageSelector());
    $translator->setFallbackLocales(['it_IT']);
    $translator->addLoader('php', new PhpFileLoader());

    foreach (glob(LANGUAGES . DS . '*.php') as $lang) {
        $translator->addResource('php', $lang, pathinfo($lang, PATHINFO_FILENAME));
    }

    return $translator;
};

// Twig
$container['view'] = function ($c) {
    $settings = $c->get('settings');
    $site_settings = $c->get('site_settings');

    $view = new \Slim\Views\Twig($settings['view']['template_path'] . DS . $site_settings['template'], $settings['view']['twig']);

    // Add extensions
    $view->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
    $view->addExtension(new Twig_Extension_Debug());
    $view->addExtension(new Twig_Extensions_Extension_I18n());

    $view->addExtension(new TranslationExtension($c->get('translator')));

    return $view;
};

// Flash messages
$container['flash'] = function ($c) {
    return new Slim\Flash\Messages;
};

$container[App\Action\BaseAction::class] = function ($c) {
    return new App\Action\BaseAction($c);
};
