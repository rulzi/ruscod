<?php
namespace Ruscod\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;
use Ruscod\Middleware\UserMiddleware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class IndexController implements ControllerProviderInterface
{
    public function indexAction(Application $app) {
        if ($app['session']->get('user')){
            $app->redirect($app['url_generator']->generate('account'));
        }
        return $app['plates']->render('index');
    }

    public function accountAction(Application $app) {

        return $app['plates']->render('home');
    }

    public function connect(Application $app) {
        $controllers = $app['controllers_factory'];

        $controllers->get('/', 'Ruscod\Controller\IndexController::indexAction')
                    ->bind('homepage');
        $controllers->get('/home', 'Ruscod\Controller\IndexController::accountAction')
                    ->bind('account')
                    ->before(function(Request $request, Application $app){ 
                        if (null === $user = $app['session']->get('user')) {
                            return new RedirectResponse('/user/login');
                        }
                    });

        return $controllers;
    }
}
