<?php
namespace App\Action;

use Slim\Container;

class BaseAction
{
    protected $view;
    protected $flash;
    protected $site_settings;
    protected $translator;
    protected $router;
    protected $viewData = [];

    public function __construct(Container $container)
    {
        $this->view = $container->get('view');
        $this->flash = $container->get('flash');
        $this->translator = $container->get('translator');
        $this->router = $container->get('router');
        $this->site_settings = $container->get('site_settings');

        $this->setBaseViewData();
    }

    public function setViewData($key, $value)
    {
        if (!array_key_exists($key, $this->viewData)) {
            $this->viewData[$key] = $value;
        } else {
            throw new \Exception("`$key` already exist in viewData", 1);
        }
    }

    private function setBaseViewData()
    {
        $this->setViewData('title', $this->site_settings['title']);
        $this->setViewData('logged', (isset($_SESSION['logged']) && $_SESSION['logged'] === true));
    }
}
