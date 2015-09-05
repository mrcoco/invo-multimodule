<?php

namespace Modules\Companies\Controllers;

use Phalcon\Mvc\Dispatcher;
use Modules\Companies\Forms as CompaniesForm;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

use \Phalcon\Mvc\Controller;


class IndexController extends \Vokuro\Controllers\BaseController
{

  /**
   *
   */
  public function initialize() {
    $this->tag->setTitle('Manage your Companies');
    $this->view->setTemplateBefore('private');
    parent::initialize();
  }

  /**
   *
   */
  public function indexAction() {
    // generate some form for delete action
    $form = new \Phalcon\Forms\Form();
    $csrf = new \Phalcon\Forms\Element\Hidden('csrf', ['value' => $this->security->getToken()]);
    $csrf->addValidator(
      new \Phalcon\Validation\Validator\Identical(
        array(
          'value'   => $this->security->getSessionToken(),
          'message' => 'CSRF validation failed'
        )
      )
    );
    $form->add($csrf);

    $this->view->setVar('form', $form);
    unset($form);


    $current_page = (int)$this->request->get('page', null, 1);
    $companies = \Modules\Companies\Models\Companies::query()
      ->order('id DESC')
      ->execute();
    $paginator = new \Phalcon\Paginator\Adapter\Model(
      array(
        'data'  => $companies,
        'limit' => 10,
        'page'  => $current_page
      )
    );
    $this->view->setVar('page', $paginator->getPaginate());
    unset($current_page, $companies, $paginator);
  }  /* indexAction */


}