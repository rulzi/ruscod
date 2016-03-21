<?php
namespace Ruscod\League\Plates;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;
use Silex\Application;

class EngineFactory implements ExtensionInterface
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;    
    }

    public function register(Engine $engine)
    {
        $engine->registerFunction('urlGenerator', [$this, 'urlGenerator']);
        $engine->registerFunction('getSession', [$this, 'getSession']);
        $engine->registerFunction('getSessionUser', [$this, 'getSessionUser']);
    }

    public function urlGenerator($url, Array $parameter = [])
    {
        return $this->app['url_generator']->generate($url, $parameter);
    }

    public function getSession($parameter)
    {
        return $this->app['session']->getFlashBag()->get($parameter);
    }

    public function getSessionUser($parameter)
    {
        return $this->app['session']->get($parameter);
    }
}
