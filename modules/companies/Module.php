<?php

namespace Modules\Companies;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;


class Module extends \Extend\ModulesAbstract
{
  protected $controller_namespace = 'Modules\\Companies\\Controllers';
  protected $module_full_path = __DIR__;

  /**
   * Register a specific autoloader for the module
   */
  public function registerAutoloaders(\Phalcon\DiInterface $di = null) {
    $loader = new Loader();
    $loader->registerNamespaces(
      array(
        'Modules\Companies\Controllers'  => __DIR__ . '/controllers/',
        'Modules\Companies\Models' => __DIR__ . '/models/',
        'Modules\Companies\Forms'  => __DIR__ . '/forms',
        'Vokuro\Controllers'          => APP_DIR . '/controllers/',
      )
    );
    $loader->register();
  } /* registerAutoloaders */


  /**
   * Register specific services for the module
   */










}