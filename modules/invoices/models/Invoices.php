<?php


namespace Modules\Invoices\Models;

class Invoices extends \Phalcon\Mvc\Model
{
  public $id;

  public $name;

  public $address;

  /**
   *
   */
  public function initialize() {
    // $this->belongsTo();// more info about relations, see the documentation.
  }// initialize

  /**
   * @return string
   */
  public function getSource() {
    return 'invoices';
  }// getSource

}