<?php

namespace Modules\Companies\Controllers;

//namespace Vokuro\Controllers;

use Phalcon\Mvc\Dispatcher;
use Modules\Companies\Forms as CompaniesForm;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

use \Phalcon\Mvc\Controller;


class CompaniesController extends Controller
{

  /**
   *
   */
  public function initialize() {
    $this->tag->setTitle('Manage your Companies');
    //parent::initialize();
  }

  /**
   *
   */
  public function browseAction() {

    $this->view->setTemplateBefore('private');
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


  /**
   * Shows the form to create a new company
   */
  public function newAction() {
    $this->view->form = new \Modules\Companies\Forms\CompaniesForm(null, array());
  }  /* newAction */

  /**
   *
   */
  public function addAction() {
    $output = [];

    // add form.
    $form = new \Modules\Companies\Forms\CompaniesForm(null, array());
    $this->view->setVar('form', $form);

    if ($this->request->isPost()) {
      if (!$form->isValid($_POST)) {
        $output['err_msg'] = '';
        foreach ($form->getMessages() as $message) {
          $this->flash->error("Message: " . $message);
        }
        unset($message);
      } else {
        // passed validated post
        $data['name'] = htmlspecialchars($this->request->getPost('name', array('trim')));
        $data['address'] = htmlspecialchars($this->request->getPost('address', 'trim'));
        $companies = new \Modules\Companies\Models\Companies();
        $companies_save = $companies->save($data);
        if ($companies_save === false) {
          $this->flash->error("Unable to insert");
          foreach ($companies->getMessages() as $message) {
            $this->flash->warning("Message: " . $message);
          }
          unset($message);
        } else {
          $this->flash->success("Saved success! The Id is: " . $companies->id);
          $this->response->redirect('companies');
        }
        unset($data, $companies, $companies_save);
      }
    }
    $this->view->setVars($output);
    unset($form, $output);
    $this->view->pick('index/form');
  } /* addAction */

  /**
   * @param string $id
   */
  public function editAction($id = '') {
    $output = [];

    $companies = \Modules\Companies\Models\Companies::findFirstById($id);

    // Add the form to the View
    $form = new \Modules\Companies\Forms\CompaniesForm($companies, ['edit' => true, 'id' => $id]);
    $this->view->setVar('form', $form);

    if ($this->request->isPost()) {
      if (!$form->isValid($_POST)) {
        $output['err_msg'] = '';
        foreach ($form->getMessages() as $message) {
          $this->flash->warning("Message: " . $message);
        }
        unset($message);
      } else {
        // passed validated post
        $form->bind($this->request->getPost(), $companies);
        $companies_save = $companies->save();
        if ($companies === false) {
          $this->flash->error("Unable to update:");
          foreach ($companies->getMessages() as $message) {
            $this->flash->warning("Message " . $message);
          }
          unset($message);
        } else {
          $this->flash->success("Saved success! The id is " . $id);
          $this->response->redirect('companies');
        }
        unset($data, $mycompanies, $companies_save);
      }
    }

    $this->view->setVars($output);
    unset($form, $output);
    $this->view->pick('index/form');
  } /* editAction */

  /**
   * Creates a new company
   */
  public function createAction() {
    $dispatcher = new Dispatcher;
    if (!$this->request->isPost()) {
      $dispatcher->forward(array(
        'namespace'  => '\\Modules\\Companies\\Controllers',
        'module'     => 'companies',
        'controller' => 'index',
        'action'     => 'index'
      ));

      return false;
    } else {
      $form = new \Modules\Companies\Forms\CompaniesForm(null, array());
      $company = new \Modules\Companies\Models\Companies();

      $data = $this->request->getPost();

      if (!$form->isValid($data, $company)) {
        foreach ($form->getMessages() as $message) {
          $this->flash->error($message);
        }

        return $this->response->redirect('companies/index/add');
      }

      if ($company->save() == false) {
        foreach ($company->getMessages() as $message) {
          $this->flash->error($message);
        }

        $this->response->redirect('companies/index/add');
      }

      $form->clear();

      $this->flash->success("Company was created successfully");

      return $this->response->redirect('/companies/index');
    }
  } /* createAction */

  /**
   * Saves The company from the edit form to the DataBase
   *
   * @param string $id
   */
  public function saveAction() {
    $dispatcher = new Dispatcher;
    if (!$this->request->isPost()) {
      $dispatcher->forward(array(
        'namespace'  => '\\Modules\\Companies\\Controllers',
        'module'     => 'companies',
        'controller' => 'index',
        'action'     => 'index'
      ));

      return false;
    } else {
      $form = new \Modules\Companies\Forms\CompaniesForm(null, array());
      //$form = new CompaniesForm;
      $id = $this->request->getPost("id", "int");
      $company = \Modules\Companies\Models\Companies::findFirstById($id);
      //$company = new \Modules\Companies\Models\Companies();

      $data = $this->request->getPost();

      $form->bind($data, $company);

      //$form->setData($request->getPost());

      if (!$form->isValid($data, $company)) {
        foreach ($form->getMessages() as $message) {
          $this->flash->error($message);
        }

        return $this->response->redirect('companies/add');
      }

      if ($company->save() == false) {
        foreach ($company->getMessages() as $message) {
          $this->flash->error($message);
        }

        $this->response->redirect('companies/index/add');
      }

      $form->clear();

      $this->flash->success("Company was Savvvved successfully");

      return $this->response->redirect('/companies/index');
    }
  }  /* saveAction */

  /**
   * Deletes a company
   *
   * @param string $id
   */
  public function deleteAction($id) {

    $companies = \Modules\Companies\Models\Companies::findFirstById($id);
    if (!$companies) {
      $this->flash->error("Company was not found");

      $this->response->redirect("companies/index");
    }

    if (!$companies->delete()) {
      foreach ($companies->getMessages() as $message) {
        $this->flash->error($message);
      }

      $this->response->redirect("companies/index");
    }

    $this->flash->success("Company was deleted");

    $this->response->redirect("companies/index");
  }  /* deleteAction */

  /**
   *
   */
  public function multipleAction() {
    $ids = $this->request->getPost('id');
    $connection = $this->_dependencyInjector->getShared('db');
    $config = $this->_dependencyInjector->getShared('config');

    if ($this->request->isPost()) {
      if (is_array($ids)) {
        foreach ($ids as $id) {
          // to use database abstraction layer, you have to manually add table prefix.
          $connection->delete($config->database->tablePrefix . 'companies', 'id = ' . $id);
        }
      }
    }
    unset($config, $connection, $id, $ids);
    $this->response->redirect('companies');
  } /* multipleAction */
}