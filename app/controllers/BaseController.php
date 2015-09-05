<?php
namespace Vokuro\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

/**
 * ControllerBase
 * This is the base controller for all controllers in the application
 */
class BaseController extends Controller
{
  /**
   *  Initializes the BaseController, which is the Base of all Controllers in InvoBegins
   *
   * @todo Get Title from the Settings table and prepend that title
   */
  protected function initialize() {
    $this->tag->prependTitle('INVO MultiModule | ');
    $this->view->setTemplateBefore('private');
  }

}
