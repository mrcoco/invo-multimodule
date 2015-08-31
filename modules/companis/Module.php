<?php

namespace Backend\Companies;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;


class Module extends \Extend\ModulesAbstract
{
  protected $controller_namespace = 'Backend\\Companies\\Controllers';
  protected $module_full_path = __DIR__;

  /**
   * Register a specific autoloader for the module
   */
  public function registerAutoloaders(\Phalcon\DiInterface $di = null) {
    $loader = new Loader();
    $loader->registerNamespaces(
      array(
        'Backend\Companies\Controllers'  => __DIR__ . '/controllers/',
        'Backend\Companies\Models' => __DIR__ . '/models/',
        'Backend\Companies\Forms'  => __DIR__ . '/forms',
        'Vokuro\Controllers'          => APP_DIR . '/controllers/',
      )
    );
    $loader->register();
  } /* registerAutoloaders */


  /**
   * Register specific services for the module
   */
  public function registerServices(\Phalcon\DiInterface $di = null)
  {
    // Registering a dispatcher
    $di->set('dispatcher', function () {
      $dispatcher = new Dispatcher();
      $dispatcher->setDefaultNamespace("Backend\Companies\Controllers");
      return $dispatcher;
    });

    // Registering the view component
    $di->set('view', function () {
      $view = new View();
      $view->setViewsDir('../apps/backend/views/');
      return $view;
    });
  }









}