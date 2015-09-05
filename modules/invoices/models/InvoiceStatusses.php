<?php

namespace Modules\Invoices\Models;

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class InvoiceStatusses extends Model
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
   * InvoiceStatusses initializer
   */
  public function initialize() {
    $this->belongsTo(
      'invoice_status',
      'Modules\Companies\Models\Companies',
      'id',
      array(
        'reusable' => true,
        'alias'    => 'company'
      )
    );
  }// initialize

  /**
   * @return string
   */
  public function getSource() {
    return 'invoice_statusses';
  }// getSource
}
