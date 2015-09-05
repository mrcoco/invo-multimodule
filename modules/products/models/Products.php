<?php

namespace Modules\Products\Models;

class Products extends \Phalcon\Mvc\Model
{
  public $id;

  public $name;

  public $address;

  /**
   * Products initializer
   */
  public function initialize() {
    /*
    $this->hasMany('product_types_id', 'Modules\Models\ProductTypes', 'id', array(
      'reusable' => true
    ));
    */
  }

  /**
   * @return string
   */
  public function getSource() {
    $config = $this->_dependencyInjector->getShared('config');

    return $config->database->tablePrefix . 'products';
  }// getSource

  /**
   * Returns a human representation of 'active'
   *
   * @return string
   */
  public function getActiveDetail() {
    if ($this->active == 'Y') {
      return 'Yes';
    }

    return 'No';
  }


}