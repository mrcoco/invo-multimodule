<?php

namespace Modules\Invoices\Forms;

use Phalcon\Forms\Form,
  Phalcon\Forms\Element\Text,
  Phalcon\Forms\Element\Hidden,
  Phalcon\Validation\Validator\PresenceOf,
  Phalcon\Validation\Validator\StringLength,
  Phalcon\Validation\Validator\Email,
  Phalcon\Validation\Validator\Identical;

class InvoicesForm extends Form
{

  /**
   * @param string $db
   * @param array  $options
   */
  public function initialize($entity = null, array $options = []) {

    // csrf
    /*
        $csrf = new Hidden('csrf');
        $csrf->addValidator(
          new Identical(
            array(
              'value'   => $this->security->getSessionToken(),
              'message' => 'CSRF validation failed'
            )
          )
        );
        $this->add($csrf);
        unset($csrf);
    */

    // id
    // We don't need to add the ID when we are Adding a new Invoice, only when we are editing a new Company
    if (isset($options['edit'])) {
      // Make the ID hidden, users don't need to know that number
      $this->add(new Hidden("id"));
    }

    // name
    $name = new Text('name');
    $name->setLabel("Name");
    $name->setFilters(array('striptags', 'string'));
    $name->addValidators(
      [
        new PresenceOf(
          ['cancelOnFail' => true]
        ),
        new StringLength(
          ['min' => 2]
        )
      ]
    );
    $this->add($name);
    unset($name);

    /*
    More invoice fields and their types!
    */


  } /* initialize */


}