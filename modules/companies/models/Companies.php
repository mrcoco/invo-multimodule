<?php


namespace Modules\Companies\Models;

class Companies extends \Phalcon\Mvc\Model
{
  /**
   * @var integer
   */
  public $id;

  /**
   * @var string
   */
  public $name;

  /**
   * @var string
   */
  public $telephone;

  /**
   * @var string
   */
  public $address;

  /**
   * @var string
   */
  public $city;

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
    return 'companies';
  }// getSource

}