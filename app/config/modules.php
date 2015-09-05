<?php

// @todo [phalconbegins][multi modules] register modules here.
// register modules -------------------------------------------------------------------------

$application->registerModules(
  array(
    'companies' => array(
      'namespace' =>  'Modules\Companies',
      'className' => 'Modules\Companies\Module',
      'path'      => APP_DIR . '/../modules/companies/Module.php',
    ),
    'invoices' => array(
      'namespace' =>  'Modules\Invoices',
      'className' => 'Modules\Invoices\Module',
      'path'      => APP_DIR . '/../modules/invoices/Module.php',
    ),
    'products' => array(
      'namespace' =>  'Modules\Products',
      'className' => 'Modules\Products\Module',
      'path'      => APP_DIR . '/../modules/products/Module.php',
    ),
    'core' => array(
      'namespace' =>  'Vokuro',
      'className' => 'Vokuro\Module',
      'path'      => APP_DIR . '/../app/Module.php',
    ),
  )
);  /* End register modules --------------------------------------------------------------------*/