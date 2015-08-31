<?php

// @todo [phalconbegins][multi modules] register modules here.
// register modules -------------------------------------------------------------------------

$application->registerModules(
  array(
    'companies' => array(
      'namespace' =>  'Modules\\Companies',
      'className' => 'Modules\\Companies\\Module',
      'path'      => APP_DIR . '/../modules/companies/Module.php',
    ),
    'backend' => array(
      'namespace' =>  'Backend\\Companies',
      'className' => 'Backend\\Companies\\Module',
      'path'      => APP_DIR . '/../modules/companis/Module.php',
    ),
    'core' => array(
      'namespace' =>  'Vokuro',
      'className' => 'Vokuro\\Module',
      'path'      => APP_DIR . '/../app/Module.php',
    ),
  )
);  /* End register modules --------------------------------------------------------------------*/