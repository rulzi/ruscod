# Ruscod
Simple Silex Framework skeleton application using :

>- [Silex](http://silex.sensiolabs.org/)
>- [Robmorgan Phinx Migrations](https://phinx.org/)
>- [Vlucas Valitron Validator](https://github.com/vlucas/valitron)
>- [Vlucas phpdotenv](https://github.com/vlucas/phpdotenv)

#How To Use

- Clone it
- Run "composer install" from cli
- Init phinx migration from cli "php vendor/bin/phinx init" on your project folder root
- Edit migrations config on phinx.yml file
- Create .env on your project root, see ".env.example" and copy the code to your .env file
- Change .env value to yours
- Create Your routes on app/routes.php
- $ php -S  localhost:8088 -t web/
- Enjoy it !