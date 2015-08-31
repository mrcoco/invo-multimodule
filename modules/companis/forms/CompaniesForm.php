<?php

namespace Modules\Companies\Forms;

use Phalcon\Forms\Form,
  Phalcon\Forms\Element\Text,
  Phalcon\Forms\Element\Hidden,
  Phalcon\Validation\Validator\PresenceOf,
  Phalcon\Validation\Validator\StringLength,
  Phalcon\Validation\Validator\Email,
  Phalcon\Validation\Validator\Identical;

class CompaniesForm extends Form
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


    // We don't need to add the ID when we are Adding a new Company, only when we are editing a new Company
    if (isset($options['edit'])) {
      // Make the ID hidden, users don't need to know that number
      $this->add(new Hidden("id"));
    }

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

    $address = new Text("address");
    $address->setLabel("address");
    $address->setLabel("address");
    $address->setFilters(array('striptags', 'string'));
    $address->addValidators(
      [
        new PresenceOf(array(
          'message' => 'Address is required'
        )),
        new StringLength(
          ['min' => 2]
        )
      ]
    );
    $this->add($address);
    unset($address);

    $telephone = new Text("telephone");
    $telephone->setLabel("Telephone");
    $telephone->setFilters(array('striptags', 'string'));
    $telephone->addValidators(array(
      new PresenceOf(array(
        'message' => 'Telephone is required'
      ))
    ));
    $this->add($telephone);
    unset($telephone);

    $city = new Text("city");
    $city->setLabel("city");
    $city->setFilters(array('striptags', 'string'));
    $city->addValidators(array(
      new PresenceOf(array(
        'message' => 'City is required'
      ))
    ));
    $this->add($city);
    unset($city);

  } /* initialize */
}