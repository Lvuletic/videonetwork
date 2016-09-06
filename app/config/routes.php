<?php

$router = new Phalcon\Mvc\Router();

$router->add('/{language:[a-z]{2}+}/?', array(
    'controller' => 'index',
    'action' => 'index',
))->setName('frontPage');

$router->add('/{language:[a-z]{2}+}/:controller', array(
    'controller' => 2,
));
$router->add('/{language:[a-z]{2}+}/:controller/:action', array(
    'controller' => 2,
    'action' => 3,
));
$router->add('/{language:[a-z]{2}+}/:controller/:action/:params', array(
    'controller' => 2,
    'action' => 3,
    'params' => 4,
));

$router->add('/{language:[a-z]{2}+}/account', array(
    'controller' => 'user',
    'action' => 'account'
))->setName('account');

$router->add('/{language:[a-z]{2}+}/login', array(
    'controller' => 'login',
    'action' => 'index'
))->setName('login');

$router->add('/{language:[a-z]{2}+}/logout', array(
    'controller' => 'login',
    'action' => 'logout'
))->setName('logout');

$router->add('/{language:[a-z]{2}+}/register', array(
    'controller' => 'user',
    'action' => 'register'
))->setName('register');

$router->add('/{language:[a-z]{2}+}/watch/:params', array(
    'controller' => 'video',
    'action' => 'watch',
    'params' => 2
))->setName('video-watch');

return $router;