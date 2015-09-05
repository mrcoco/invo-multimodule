<?php
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Crypt;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Files as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use Phalcon\Flash\Direct as Flash;

use Vokuro\Auth\Auth;
use Vokuro\Acl\Acl;
use Vokuro\Mail\Mail;

/**
 * The FactoryDefault Dependency Injector automatically registers the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * Register the global configuration as config
 */
$di->set('config', $config);

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function () use ($config) {
  $url = new UrlResolver();
  $url->setBaseUri($config->application->baseUri);

  return $url;
}, true); /* End the Url Component */

/**
 * Setting up the view component
 */
$di->set('view', function () use ($config) {

  $view = new View();

  $view->setViewsDir($config->application->viewsDir);

  $view->registerEngines(array(
    '.volt' => function ($view, $di) use ($config) {

      $volt = new VoltEngine($view, $di);

      $volt->setOptions(array(
        'compiledPath'      => $config->application->cacheDir . 'volt/',
        'compiledSeparator' => '_'
      ));

      return $volt;
    }
  ));

  return $view;
}, true);

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db', function () use ($config) {
  return new DbAdapter(array(
    'host'     => $config->database->host,
    'username' => $config->database->username,
    'password' => $config->database->password,
    'dbname'   => $config->database->dbname,
    'charset'  => $config->database->charset,
  ));
}); /* End the DB Component */

/**
 * Starting the debugging tool
 */
$debug = new \Phalcon\Debug();
$debug->listen();

$whoops = new Whoops\Provider\Phalcon\WhoopsServiceProvider($di);


/**
 * If the configuration specifies the use of metadata adapter use it or use memory instead
 */
$di->set('modelsMetadata', function () use ($config) {
  return new MetaDataAdapter(array(
    'metaDataDir' => $config->application->cacheDir . 'metaData/'
  ));
}); /* End the MetaData Component */

/**
 * The Logger File
 */
$di->set('loggerFile', function () use ($config) {
  if (!file_exists($config->application->logDir . date('Y-m-d'))) {
    mkdir($config->application->logDir . date('Y-m-d'));
  }

  return new LoggerFile($config->application->logDir . date('Y-m-d') . '/application.log');
}); /* End the Logger File */






/**
 * Start the session the first time some component requests the session service
 */
$di->set('session', function () {
  $session = new SessionAdapter();
  $session->start();

  return $session;
}); /* End the Session Component */

/**
 * set crypt key. this key also use with cookies.
 */
$di->set('crypt', function () use ($config) {
  $crypt = new Crypt();
  $crypt->setKey($config->application->cryptSalt);

  return $crypt;
});/* End the Crypt Component, needed for security */

/**
 * Dispatcher use a default namespace
 */
/*
$di->set('dispatcher', function () {
  $dispatcher = new Dispatcher();
  $dispatcher->setDefaultNamespace('Vokuro\Controllers');
  return $dispatcher;
});
*/



/**
 * add router support.
 */
$di->set('router', function () {
  $router = require __DIR__ . '/routes.php';

  return $router;
}); /* End the Router Support */




/**
 * Register the flash service with custom CSS classes (from Bootstrap of course)
 */
$di->set('flash', function () {
  return new Flash(array(
    'error'   => 'alert alert-danger',
    'success' => 'alert alert-success',
    'notice'  => 'alert alert-info',
    'warning' => 'alert alert-warning'
  ));
}); /* End the Flash Component */


/**
 * Registers a user component, Elements in this case, from the original Invo App
 * Elements creates menu structure AND tabs when some of the modules are selected
 */
/*
$di->set('elements', function () {
  return new \Libraries\Elements();
});
*/
/* End the Elements Component */


/**
 * Custom authentication component
 */
$di->set('auth', function () {
  return new Auth();
});

/**
 * Mail service uses AmazonSES
 */
$di->set('mail', function () {
  return new Mail();
});

/**
 * Access Control List
 */
$di->set('acl', function () {
  return new Acl();
});
