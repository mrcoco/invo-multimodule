<?php

/**
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 * Development environments
 */
const ENVIRONMENT_PRODUCTION = 'production';
const ENVIRONMENT_DEVELOPMENT = 'development';
const ENVIRONMENT_MAINTENANCE = 'maintenance';

define ('ENVIRONMENT', ENVIRONMENT_DEVELOPMENT);
/**
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 */

$aModules = array('frontend', 'admin');

return new \Phalcon\Config(array(
  'database'    => array(
    'adapter'     => 'Mysql',
    'host'        => '127.0.0.1',
    'username'    => 'username',
    'password'    => 'password',
        'dbname' => 'mydb',
    'charset'     => 'utf8',
    'tablePrefix' => '',
  ),
  'application' => array(
    'controllersDir' => APP_DIR . '/controllers/',
    'modelsDir'      => APP_DIR . '/models/',
    'formsDir'       => APP_DIR . '/forms/',
    'viewsDir'       => APP_DIR . '/views/',
    'libraryDir'     => APP_DIR . '/library/',
    'extendDir'      => APP_DIR . '/extend/',
    'pluginsDir'     => APP_DIR . '/plugins/',
    'cacheDir'       => APP_DIR . '/cache/',
    'baseUri'        => '/',
    'publicUrl'      => '',
    'cryptSalt'      => 'eEAfR|_&G&f,+vU]:jFr!!A&+71w1Ms9~8_4L!<@[N@DyaIP_2My|:+.u>/6m,$D'
  ),
  'mail'        => array(
    'fromName'  => 'Vokuro',
    'fromEmail' => 'phosphorum@phalconphp.com',
    'smtp'      => array(
      'server'   => 'smtp.gmail.com',
      'port'     => 587,
      'security' => 'tls',
      'username' => '',
      'password' => ''
    ),
    'cookies'   => array(
      'cryptKey' => '$#19AdB+?gHk(_pI',// 16, 24, 32 characters
      'prefix'   => 'invobegins_',
    ),
  ),
  'amazon'      => array(
    'AWSAccessKeyId' => '',
    'AWSSecretKey'   => ''
  )
));
