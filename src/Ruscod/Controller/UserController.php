<?php
namespace Ruscod\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;
use Valitron\Validator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Ruscod\Model\UserModel;

class UserController implements ControllerProviderInterface
{
    public function indexAction(Application $app) {
        return "Hello User";
    }

    public function registerAction(Application $app) {
        return $app['plates']->render('register');
    }

    public function registerSaveAction(Application $app, Request $request) {
        $v = new Validator($request->request->all());
        $v->rule('required', ['name', 'email','address', 'phone', 'password']);
        $v->rule('email', 'email');
        $v->rule('equals', 'password', 'password_confirmation');
        if($v->validate()) {
            $user = new UserModel($app);
            $user->register($request->request->all());
            $app['session']->getFlashBag()->add('message', 'Register Success');
            return $app->redirect($app['url_generator']->generate('login'));
        } else {
            $errors = $v->errors();
            return $app['plates']->render('register', ['errors' => $errors]);
        }
    }

    public function loginAction(Application $app) {
        return $app['plates']->render('login');
    }

    public function dologinAction(Application $app, Request $request) {
        $v = new Validator($request->request->all());
        $v->rule('required', ['email', 'password']);
        if($v->validate()) {
            $user = new UserModel($app);
            $login = $user->login($request->request->all());

            $app['session']->set('user', array('id' => $login['id']));
            // var_dump(expression);exit();
            return $app->redirect($app['url_generator']->generate('account'));
        } else {
            $errors = $v->errors();
            return $app['plates']->render('dologin', ['errors' => $errors]);
        }
    }

    public function logoutAction(Application $app) {
        $app['session']->remove('user');
        return $app->redirect($app['url_generator']->generate('login'));
    }

    public function connect(Application $app) {
        $controllers = $app['controllers_factory'];

        $controllers->get('/', 'Ruscod\Controller\UserController::indexAction');
        $controllers->get('/register', 'Ruscod\Controller\UserController::registerAction')
                    ->bind('register');
        $controllers->post('/register', 'Ruscod\Controller\UserController::registerSaveAction')
                    ->bind('register-save');
        $controllers->get('/login', 'Ruscod\Controller\UserController::loginAction')
                    ->bind('login');
        $controllers->post('/login', 'Ruscod\Controller\UserController::dologinAction')
                    ->bind('dologin');
        $controllers->get('/logout', 'Ruscod\Controller\UserController::logoutAction')
                    ->bind('logout');

        return $controllers;
    }
}
