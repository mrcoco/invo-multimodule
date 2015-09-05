<?php


namespace Modules\Products;

use Phalcon\Loader;

class Module extends \Extend\ModulesAbstract
{

  protected $controller_namespace = 'Modules\\Products\\Controllers';
  protected $module_full_path = __DIR__;

  /**
   * Register a specific autoloader for the module
   */
  public function registerAutoloaders(\Phalcon\DiInterface $di = null) // <- here it is)
  {

    $loader = new Loader();

    $loader->registerNamespaces(
      array(
        $this->controller_namespace => __DIR__ . '/controllers/',
        'Modules\\Products\\Models' => __DIR__ . '/models/',
        'Modules\\Products\\Forms'  => __DIR__ . '/forms',
        'Core\\Controllers'         => APPFULLPATH . '/controllers/',
      )
    );

    $loader->register();
  } /* registerAutoloaders */


}