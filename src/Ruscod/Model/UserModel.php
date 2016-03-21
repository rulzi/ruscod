<?php
namespace Ruscod\Model;

use Silex\Application;

class UserModel
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;    
    }

    public function register(array $data = [])
    {
        $password = hash('sha512', $data['password']);
        $this->app['db']->insert('users', [
            'name' => $data['name'],
            'password' => $password,
            'email' => $data['email'],
            'address' => $data['address'],
            'phone_number' => $data['phone'],
        ]);
    }

    public function login(array $data = [])
    {
        $email = $data['email'];
        $password = hash('sha512', $data['password']);
        $sql = "SELECT * FROM users WHERE email = '".$email."' AND password = '".$password."'";
        $user = $this->app['db']->fetchAssoc($sql);

        if(empty($user)){
            return false;
        }
        return $user;
    }
}