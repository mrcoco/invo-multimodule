<?php


namespace Extend;

use Phalcon\Loader,
  Phalcon\Mvc\Dispatcher,
  Phalcon\Mvc\View,
  Phalcon\Mvc\View\Engine\Volt,
  Plugins;

/**
 * Modules trait.<br><br>
 * Use this file to manage register services in one place.<br>
 * To use this trait, set your module like Phalcon Module.php but extend \Extend\ModulesAbstract<br>
 * Setup $controller_namespace property for Module class to your default controller namespace<br>
 * Set $module_full_path property to __DIR__ for easy to manage.<br>
 */
trait ModulesTrait
{

  protected $default_controller_namespace = 'Vokuro\\Controllers';
  protected $default_module_full_path = APP_DIR;

  /**
   * Register specific services for the module
   */
  public function registerServices(\Phalcon\DiInterface $di = null) // <- here it is
  {
    // get module caller class to retrieve data-----------
    $ModuleType = '';
    $module_caller_name = get_called_class();

    //echo $module_caller_name."<br />";

    $module_caller = new $module_caller_name;
    if (property_exists($module_caller, 'controller_namespace')) {
      //echo "a ".$module_caller->controller_namespace."<br />";
      $default_namespace = $module_caller->controller_namespace;
    } else {
      //echo "b ".$this->default_controller_namespace."<br />";
      $default_namespace = $this->default_controller_namespace;
    }

    if (property_exists($module_caller, 'module_full_path')) {
      $module_full_path = str_replace('\\', '/', $module_caller->module_full_path);
    } else {
      $module_full_path = str_replace('\\', '/', $this->default_module_full_path);
    }

    //echo $module_full_path . "<br />";
    if (strstr($module_full_path, 'modules')) {
      $ModuleType = 'module';
    } else {
      $ModuleType = 'core';
    }

    //unset($module_caller_name);
    // end get module caller class ---------------------------

    //echo APP_DIR . '/config/config.php'."<br />";

    $config = include APP_DIR . '/config/config.php';

    // Registering the view component
    $di->set('view', function () use ($config, $module_full_path, $ModuleType) {
      $view = new View();

      /*
       *  When needed : layouts dir. Problem is that it overrides my index, which i don't want
       **/
      //echo "my moduletype is ".$ModuleType."<br />";

      if ($ModuleType == "module") {
        $view->setLayoutsDir("../../../app/views/layouts/");
      } else {
        //echo "why is my ".$module_full_path." moduletype core?<br />";
        //$ModuleType = 'core';
        $view->setLayoutsDir("layouts/");
      }

      $view->setViewsDir($module_full_path . '/views/');

      $this->default_module_full_path = str_replace('\\', '/', $this->default_module_full_path);
      if ($module_full_path != $this->default_module_full_path) {
        //echo "what ".$module_full_path." is going ".$this->default_module_full_path." on?<br />";
        $view->setMainView('../../../app/views/index');
      }

      $view->registerEngines(array(
        '.volt'  => function ($view, $di) use ($config) {

          $volt = new Volt($view, $di);

          if (!file_exists($config->application->cacheDir . 'volt/')) {
            mkdir($config->application->cacheDir . 'volt/');
          }

          $volt->setOptions(array(
            'compiledPath'      => $config->application->cacheDir . 'volt/',
            'compiledSeparator' => '_'
          ));
          $compiler = $volt->getCompiler();
          $compiler->addFunction('is_a', 'is_a');

          return $volt;
        },
        '.phtml' => 'Phalcon\Mvc\View\Engine\Php',
        '.php'   => 'Phalcon\Mvc\View\Engine\Php'
      ));

      return $view;
    }); /* End View Service */


    // Registering a dispatcher
    $di->set('dispatcher', function () use ($di, $default_namespace) {

      $eventsManager = $di->getShared('eventsManager');

      $dispatcher = new Dispatcher;

      /*
       *  Adding the notfound plugin
       **/
      $eventsManager->attach('dispatch:beforeException', new \Plugins\ExceptionsPlugin);

      $dispatcher->setEventsManager($eventsManager);
      $dispatcher->setDefaultNamespace($default_namespace);

      return $dispatcher;
    }); /* End dispatcher Registration */


    unset($default_namespace, $module_full_path);
  } /* End registerServices */
}