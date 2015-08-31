<?php
/*
 * Define custom routes. File gets included in the router service definition.
 */
$router = new Phalcon\Mvc\Router();

$router->add('/confirm/{code}/{email}', array(
    'controller' => 'user_control',
    'action' => 'confirmEmail'
));


$router->add('/notexist', array(
  'module' => 'companis',
  'controller' => 'user_control',
  'action' => 'resetPassword'
));



$router->add('/reset-password/{code}/{email}', array(
    'controller' => 'user_control',
    'action' => 'resetPassword'
));


$router->add('/companies', array(
  'namespace' => 'Modules\\Companies\\Controllers',
  'module' => 'companies',
  'controller' => 'companies',
  'action' => 'browse'
));

$router->add('/companies/someaction', array(
  'namespace' => 'Modules\\Companies\\Controllers',
  'module' => 'companies',
  'controller' => 'indux',
  'action' => 'index'
));


$router->add("/login", array(
  'module'     => 'companies',
  'controller' => 'companies',
  'action'     => 'browse',
));

$router->add("/admin/products/:action", array(
  'module'     => 'backend',
  'controller' => 'products',
  'action'     => 1,
));

$router->add("/products/:action", array(
  'controller' => 'products',
  'action'     => 1,
));


$router->add('/', array(
  'namespace' => 'Vokuro\\Controllers',
  'module' => 'core',
  'controller' => 'index',
  'action' => 'index'
));



return $router;
